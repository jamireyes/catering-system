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

        $query = Order::selectRaw("
                orders.id as order_id,
                DATE_FORMAT(orders.created_at, '%M %d, %Y') as order_date,
                c.id as user_id,
                c.name as c_name,
                c.phone_number as c_contact,
                c.email as c_email,
                CONCAT_WS(' ', c.address_1, c.address_2, c.city, c.state, c.zipcode) as c_address,
                u.name as u_name,
                u.phone_number as u_contact,
                u.email as u_email,
                CONCAT_WS(' ', u.address_1, u.address_2, c.city, u.state, u.zipcode) as u_address,
                packages.name as package_name, 
                packages.pax, 
                packages.price, 
                packages.inclusion
            ")
            ->join('packages', 'orders.package_id', 'packages.id')
            ->join('users AS c', 'packages.user_id', 'c.id')
            ->join('users AS u', 'orders.user_id', 'u.id')
            ->orderByDesc('order_date');

        if($request->start && $request->end){            
            $start = Carbon::createFromFormat('m/d/Y', $request->start);
            $end = Carbon::createFromFormat('m/d/Y', $request->end);

            $query = $query->whereDate('orders.created_at', '>=', $start)->whereDate('orders.created_at', '<=', $end);
        }else{
            $query = $query->limit(5);
        }
        
        if(Auth::user()->role == 'ADMIN'){
            $orders = $query->get();
        }elseif(Auth::user()->role == 'SELLER'){
            $orders = $query->where('packages.user_id', Auth::id())->get();
        }else{
            $orders = $query->where('orders.user_id', Auth::id())->get();
        }

        $count = $orders->count();

        if(!$orders->isEmpty()){
            foreach($orders as $order){
                $user_id = $order->user_id;
                $order_id = $order->order_id;
            }

            $items = Item::selectRaw('items.name as name, order_items.quantity as qty, categories.name as category')
                ->join('order_items', 'items.id', 'order_items.item_id')
                ->join('categories', 'items.category_id', 'categories.id')
                ->where('order_items.order_id', $order_id)
                ->get();

            $categories = Category::select('name')->where('user_id', $user_id)->get();

            return view('pages.orders.index', compact(['orders', 'items', 'categories', 'count']));
        }else{
            Session::now('info', $info);
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
