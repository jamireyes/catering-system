<?php

namespace App\Http\Controllers;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use App\Models\User;
use App\Models\Package;
use Auth;
use DB;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
        if(Auth::user()->role == 'USER'){
            return view('profile.edit');
        }
        
        // Dashboard Tiles
        $sales = DB::table('orders')
            ->selectRaw("SUM(packages.price) as sales, COUNT(orders.id) as count")
            ->join('packages', 'orders.package_id', 'packages.id')
            ->whereMonth('orders.created_at', now()->month)
            ->get();

        $total_users = User::count();
        $total_packages = Package::count();
        $monthly_sale = $sales[0]->sales;
        $monthly_order = $sales[0]->count;

        // Dashboard Charts
        $first_year = User::selectRaw('date_format(created_at, "%Y") as year')
            ->first();
        $last_year = User::selectRaw('date_format(created_at, "%Y") as year')
            ->get()
            ->last();

        $monthly_users = User::selectRaw("date_format(created_at, '%m') as month, count(id) as total_users, role")
            ->where('role', 'USER')
            ->whereBetween('created_at', ['2022-01-01 00:00:00', now()])
            ->groupBy('month', 'role')
            ->get()
            ->toArray();

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
                'role' => $item['role'
            ]]);
        });

        $monthly_users_label = $collection->pluck('month');
        $monthly_users_data = $collection->pluck('total_users');

        return view('pages.dashboard', compact([
                'monthly_sale', 
                'monthly_order', 
                'total_users', 
                'total_packages', 
                'monthly_users_label', 
                'monthly_users_data'
            ]));
    }
}
