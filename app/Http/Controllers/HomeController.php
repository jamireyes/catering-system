<?php

namespace App\Http\Controllers;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\User;
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
            return view('profile.edit');
        }
        
        // Dashboard Tiles
        $sale_query = DB::table('orders')
            ->selectRaw("SUM(packages.price) as sales, COUNT(orders.id) as count")
            ->join('packages', 'orders.package_id', 'packages.id')
            ->whereMonth('orders.created_at', now()->month);

        if(Auth::user()->role == 'ADMIN'){
            $sales = $sale_query->get();
        }else if(Auth::user()->role == 'SELLER'){                
            $sales = $sale_query->where('packages.user_id', Auth::id())->get();
        }


        $total_users = User::count();
        $total_packages = Package::count();
        $monthly_sale = $sales[0]->sales;
        $monthly_order = $sales[0]->count;

        // Dashboard Charts
        $user_query = User::selectRaw('date_format(created_at, "%Y") as year');

        $first_year = $user_query->first();
        $last_year = $user_query->get()->last();

        $monthly_users = User::selectRaw("date_format(created_at, '%m') as month, count(id) as total_users, role")
            ->where('role', 'USER')
            ->whereYear('created_at', now())
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
