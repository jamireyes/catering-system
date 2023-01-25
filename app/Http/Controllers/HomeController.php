<?php

namespace App\Http\Controllers;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\User;
use App\Models\Order;
use App\Models\Favorite;
use App\Models\Team;
use App\Models\Member;
use Illuminate\Support\Arr;
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
        if(Auth::user()->role == 'USER'){
            $favorites = Favorite::selectRaw('favorites.created_at as date, packages.id as package_id, packages.name as name, packages.pax as pax, packages.price as price, packages.discount as discount')
                ->where('favorites.user_id', Auth::id())
                ->join('packages', 'favorites.package_id', 'packages.id')
                ->orderBy('date', 'DESC')
                ->get();

            $orders = Order::selectRaw('status, COUNT(status) as count')
                ->where('user_id', Auth::id())
                ->where('deleted_at', NULL)
                ->groupBy('status')
                ->get();

            $orders = collect($orders->toArray());

            if(!$orders->contains('status', 'CANCELLED')){
                $orders->push(['status' => 'CANCELLED', 'count' => 0]);
            }

            if(!$orders->contains('status', 'CONFIRMED')){
                $orders->push(['status' => 'CONFIRMED', 'count' => 0]);
            }

            if(!$orders->contains('status', 'PENDING')){
                $orders->push(['status' => 'PENDING', 'count' => 0]);
            }

            $teams = Team::selectRaw('teams.id as team_id, teams.order_id as order_id, teams.created_at as date, packages.name as package_name, packages.pax as pax')
                ->join('orders', 'teams.order_id', 'orders.id')
                ->join('packages', 'orders.package_id', 'packages.id')
                ->where('orders.user_id', Auth::id())
                ->where('teams.deleted_at', NULL)
                ->orderBy('date', 'DESC')
                ->get();
                
            $members = Member::selectRaw('team_id, role, name')
                ->whereIn('team_id', $teams->pluck('team_id')->toArray())
                ->where('deleted_at', NULL)
                ->get();

            return view('user-dashboard', compact(['favorites', 'orders', 'teams', 'members']));
        }
        
        // Gets sales reports such as current total monthly sales and total monthly orders.
        $sale_query = Order::selectRaw("SUM(orders.subtotal - IFNULL(orders.discount, 0)) as sales, COUNT(orders.id) as count")
            ->join('packages', 'orders.package_id', 'packages.id')
            ->where('orders.status', 'CONFIRMED');

        $total_users = User::select('users.id')->where('users.role', 'USER');
        $total_packages = Package::select('packages.id');

        // Monthly Sales Chart - query
        $monthly_sales_query = Order::selectRaw("date_format(orders.created_at, '%m') as month, COUNT(orders.id) as total_orders, SUM(orders.subtotal - IFNULL(orders.discount, 0)) as total_sales, SUM((orders.subtotal - IFNULL(orders.discount, 0)) - packages.cost_price) as total_profits")
            ->join('packages', 'orders.package_id', 'packages.id')
            ->where('orders.status', 'CONFIRMED')
            ->groupBy('month')
            ->orderBy('month');

        // Monthly Users Charts - query
        $monthly_users_query = User::selectRaw("date_format(created_at, '%m') as month, count(id) as total_users, role")
            ->where('role', 'USER')
            ->groupBy('month', 'role');

        if($request->filter_year){
            $monthly_users_query = $monthly_users_query->whereYear('created_at', $request->filter_year)->get()->toArray();
            $monthly_sales_query = $monthly_sales_query->whereYear('orders.created_at', $request->filter_year);
            $total_users = $total_users->whereYear('created_at', $request->filter_year)->count();
            $total_packages = $total_packages->whereYear('created_at', $request->filter_year)->count();
            $sale_query = $sale_query->whereYear('orders.created_at', $request->filter_year);
        }else {
            $monthly_users_query = $monthly_users_query->whereYear('created_at', now())->get()->toArray();
            $monthly_sales_query = $monthly_sales_query->whereYear('orders.created_at', now()->year);
            $total_users = $total_users->whereYear('created_at', now()->year)->count();
            $total_packages = $total_packages->whereYear('created_at', now()->year)->count();
            $sale_query = $sale_query->whereYear('orders.created_at', now()->year);
        }

        if(Auth::user()->role == 'ADMIN'){
            $sales = $sale_query->get();
            $monthly_sales_query = $monthly_sales_query->get()->toArray();
        }elseif(Auth::user()->role == 'SELLER'){                
            $sales = $sale_query->where('packages.user_id', Auth::id())->get();
            $monthly_sales_query = $monthly_sales_query->where('packages.user_id', Auth::id())->get()->toArray();
        }

        $monthly_sale = $sales[0]->sales; // Gets current total monthly sales.
        $monthly_order = $sales[0]->count; // Gets current total monthly orders.

        $collection = collect($monthly_users_query)->sortBy('month');
        
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

        $ms_collection = collect($monthly_sales_query);

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
