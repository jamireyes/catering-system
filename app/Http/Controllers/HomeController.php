<?php

namespace App\Http\Controllers;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\User;
use App\Models\Order;
use Auth;
use DB;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {   
        // Redirects USERS to the profile settings page.
        if(Auth::user()->role == 'USER'){
            return view('profile.edit');
        }
        
        // Gets sales reports such as current total monthly sales and total monthly orders.
        $sale_query = Order::selectRaw("SUM(packages.price) as sales, COUNT(orders.id) as count")
            ->join('packages', 'orders.package_id', 'packages.id');

        // Monthly Sales Chart - query
        $monthly_sales_query = Order::selectRaw("date_format(orders.created_at, '%m') as month, COUNT(orders.id) as total_orders, SUM(orders.subtotal - IFNULL(orders.discount, 0)) as total_sales, SUM((orders.subtotal - IFNULL(orders.discount, 0)) - packages.cost_price) as total_profits")
            ->join('packages', 'orders.package_id', 'packages.id')
            ->groupBy('month')
            ->orderBy('month');

        $total_users = User::count(); // Gets total users.
        $total_packages = Package::count(); // Gets total packages.

        if(Auth::user()->role == 'ADMIN'){
            $sales = $sale_query->get();
        }else if(Auth::user()->role == 'SELLER'){                
            $sales = $sale_query->where('packages.user_id', Auth::id())->get();
            $monthly_sales_query = $monthly_sales_query->where('packages.user_id', Auth::id());
        }

        $monthly_sale = $sales[0]->sales; // Gets current total monthly sales.
        $monthly_order = $sales[0]->count; // Gets current total monthly orders.

        // Monthly Users Charts - query
        $monthly_users_query = User::selectRaw("date_format(created_at, '%m') as month, count(id) as total_users, role")
            ->where('role', 'USER')
            ->groupBy('month', 'role');

        if($request->filter_year){
            $monthly_users = $monthly_users_query->whereYear('created_at', $request->filter_year)->get()->toArray();
            $monthly_sales = $monthly_sales_query->whereYear('orders.created_at', $request->filter_year)->get()->toArray();
        }else {
            $monthly_users = $monthly_users_query->whereYear('created_at', now())->get()->toArray();
            $monthly_sales = $monthly_sales_query->whereYear('orders.created_at', now()->year)->get()->toArray();
        }

        $collection = collect($monthly_users)->sortBy('month');
        
        for($x = 1;$x <= 12; $x++){
            if(!$collection->contains('month', $x)){
                $collection->push(['month' => $x, 'total_users' => 0, 'role' => 'USER']);
            }
        }       

        $collection = $collection->sortBy('month');

        $collection = $collection->map(function($item){
            return collect([
                'month' => date("F", mktime(0, 0, 0, (int)$item['month'], 10)), 
                'total_users' => $item['total_users'], 
                'role' => $item['role']
            ]);
        });

        $monthly_users_data = $collection->pluck('total_users');

        $ms_collection = collect($monthly_sales);

        for($x = 1;$x <= 12; $x++){
            if(!$ms_collection->contains('month', $x)){
                $ms_collection->push(['month' => $x, 'total_orders' => 0, 'total_sales' => 0, 'total_profits' => 0]);
            }
        } 

        $ms_collection = $ms_collection->sortBy('month');

        $monthly_sales = $ms_collection->map(function($item){
            return collect([
                'month' => date("F", mktime(0, 0, 0, (int)$item['month'], 10)),
                'total_orders' => $item['total_orders'],
                'total_sales' => $item['total_sales'],
                'total_profits' => $item['total_profits']
            ]);
        });

        $monthly_total_orders = $monthly_sales->pluck('total_orders');
        $monthly_total_sales = $monthly_sales->pluck('total_sales');
        $monthly_total_profits = $monthly_sales->pluck('total_profits');

        return view('pages.dashboard', compact([
            'monthly_sale', 
            'monthly_order', 
            'total_users', 
            'total_packages', 
            'monthly_users_data',
            'monthly_total_orders',
            'monthly_total_sales',
            'monthly_total_profits'
        ]));
    }
}
