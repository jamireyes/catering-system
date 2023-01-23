<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use App\Notifications\NotifySeller;
use App\Notifications\NotifyUserOrderPlaced;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Notification;
use Cart;
use Auth;

class CheckoutController extends Controller
{

    public function index()
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }

        if(Auth::user()->role != 'USER'){
            return abort('401');
        }

        if(Cart::content()->isEmpty()){
            return redirect()->route('shop.index');
        }else{
            foreach(Cart::content() as $row){
                if($row->id == 'package'){
                    $package_id = $row->options->id;
                }
            }
            
            $categories = Category::select('categories.name')
                ->join('category_rules', 'categories.id', 'category_rules.category_id')
                ->where('category_rules.package_id', $package_id)
                ->get();
        }
        
        $user = Auth::user();

        return view('checkout', compact(['user', 'categories']));
    }

    public function store(Request $request)
    {   
        Cart::destroy();

        if(Auth::user()->role != 'USER'){
            return abort('401');
        }

        $categories = new Collection;
        
        foreach($request->category as $c){
            $categories->push([json_decode($c)->id => json_decode($c)->name]);
        }

        if($request->discount){
            Cart::setGlobalDiscount($request->discount);
        }

        Cart::add([
            'id' => 'package',
            'name' => $request->name,
            'qty' => 1,
            'price' => $request->price,
            'weight' => 0,
            'options' => [
                'id' => $request->id, 
                'pax' => $request->pax, 
                'inclusion' => $request->inclusion, 
                'user' => $request->user,
                'cater_email' => $request->cater_email
            ],
        ]);

        foreach($request->items as $item){
            foreach($request->category as $c){
                if(json_decode($item)->category_id == json_decode($c)->id){
                    Cart::add([
                        'id' => json_decode($item)->id,
                        'name' => json_decode($item)->name,
                        'qty' => 1,
                        'price' => 0.00,
                        'weight' => 0,
                        'options' => ['category' => json_decode($c)->name]
                    ]);
                }
            }
            
        }

        return redirect()->route('checkout.index');
    }

    public function confirm(Request $request)
    {       
        if(Auth::user()->role != 'USER'){
            return abort('401');
        }

        $request->validate([
            'phone_number' => 'required',
            'address_1' => 'required',
            'address_2' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zipcode' => 'required',
            'payment_method' => 'required',
            'payment_file' => 'required',
            'reservation_date' => 'required',
        ]);

        if($request->hasFile('payment_file')){
            $file = $request->payment_file;
            $mime_type = $request->payment_file->getMimeType();
            $hash = $request->payment_file->hashName();
            $path = Storage::disk('spaces')->putFileAs('proof_of_payments', $file, $hash);
        }

        $user = User::find(Auth::id());
        $user->phone_number = $request->phone_number;
        $user->address_1 = $request->address_1;
        $user->address_2 = $request->address_2;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->zipcode = $request->zipcode;
        $user->save();

        $items = new Collection;

        foreach(Cart::content() as $row){
            if($row->id == 'package'){
                $package_id = $row->options->id;
                $cater_email = $row->options->cater_email;
            }else{
                $items->push(['id' => $row->id, 'qty' => $row->qty]);
            }
        }        

        $order = new Order;
        $order->user_id = Auth::id();
        $order->package_id = $package_id;
        $order->discount = Cart::discount(2, '.', '');
        $order->subtotal = Cart::initial(2, '.', '');
        $order->status = 'PENDING';
        $order->payment_method = $request->payment_method;
        $order->payment_file = $path;
        $order->payment_mime_type = $mime_type;
        $order->reservation_date = $request->reservation_date;
        $order->note = $request->note;
        $order->save();

        foreach($items as $item){
            $orderItem = new OrderItem;
            $orderItem->order_id = $order->id;
            $orderItem->item_id = $item['id'];
            $orderItem->quantity = $item['qty'];
            $orderItem->save();
        }

        Notification::route('mail', $cater_email)->notify(new NotifySeller($order->id));

        Cart::destroy();

        return view('confirmation');
    }
}
