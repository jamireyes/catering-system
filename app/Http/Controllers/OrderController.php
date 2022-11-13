<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Item;
use App\Models\OrderItem;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Cart;
use Auth;
use Session;

class OrderController extends Controller
{        
    public function index(Request $request)
    {   
        $info = 'No records found! Please try again.';
        
        if($request->start && $request->end){
            $start = Carbon::createFromFormat('m/d/Y', $request->start);
            $end = Carbon::createFromFormat('m/d/Y', $request->end);
            
            $query = Order::selectRaw("orders.id, DATE_FORMAT(orders.created_at, '%M %d, %Y') as order_date, users.name as company, users.id as user_id, packages.name as package_name, packages.pax, packages.price, packages.inclusion, CONCAT_WS(' ', users.address_1, users.address_2, users.city, users.state, users.zipcode) as address, users.phone_number as phone")
                ->join('packages', 'orders.package_id', 'packages.id')
                ->join('users', 'packages.user_id', 'users.id')
                ->whereBetween('orders.created_at', [$start.' 00:00:00', $end.' 23:59:59']);
            
            if(Auth::user()->role == 'ADMIN'){
                $orders = $query->get();
            }elseif(Auth::user()->role == 'SELLER'){
                $orders = $query->where('packages.user_id', Auth::id())->get();
            }else{
                $orders = $query->where('orders.user_id', Auth::id())->get();
            }

            if(!$orders->isEmpty()){
                foreach($orders as $order){
                    $user_id = $order->user_id;
                    $order_id = $order->id;
                }
    
                $items = Item::selectRaw('items.name as name, order_items.quantity as qty, categories.name as category')
                    ->join('order_items', 'items.id', 'order_items.item_id')
                    ->join('categories', 'items.category_id', 'categories.id')
                    ->where('order_items.order_id', $order_id)
                    ->get();
    
                $categories = Category::select('name')->where('user_id', $user_id)->get();

                return view('pages.orders.index', compact(['orders', 'items', 'categories']));
            }else{
                Session::now('info', $info);
            }
        }

        return view('pages.orders.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Order $order)
    {
        //
    }

    public function edit(Order $order)
    {
        //
    }

    public function update(Request $request, Order $order)
    {
        //
    }

    public function destroy(Order $order)
    {
        //
    }
}
