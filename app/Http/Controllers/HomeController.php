<?php

namespace App\Http\Controllers;

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
        $sales = DB::table('orders')
            ->selectRaw("SUM(packages.price) as sales, COUNT(orders.id) as count")
            ->join('packages', 'orders.package_id', 'packages.id')
            ->whereMonth('orders.created_at', now()->month)
            ->get();

        $total_users = User::count();
        $total_packages = Package::count();

        $monthly_sale = $sales[0]->sales;
        $monthly_order = $sales[0]->count;

        if(Auth::user()->role == 'USER'){
            return view('profile.edit');
        }

        return view('pages.dashboard', compact(['monthly_sale', 'monthly_order', 'total_users', 'total_packages']));
    }
}
