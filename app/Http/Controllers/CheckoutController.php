<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Cart;
use Auth;

class CheckoutController extends Controller
{

    public function index()
    {
        if(!Auth::check()){
            return redirect()->route('login');
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
            'options' => ['id' => $request->id, 'pax' => $request->pax, 'inclusion' => $request->inclusion, 'user' => $request->user],
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
        $order->save();

        foreach($items as $item){
            $orderItem = new OrderItem;
            $orderItem->order_id = $order->id;
            $orderItem->item_id = $item['id'];
            $orderItem->quantity = $item['qty'];
            $orderItem->save();
        }

        Cart::destroy();

        return view('confirmation');
    }
}
