<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\CategoryRule;
use App\Models\Category;
use App\Models\Item;
use Auth;
use DB;
use Session;

class ShopController extends Controller
{
   
    public function index(Request $request)
    {
        $min_price = Package::min('price');
        $max_price = Package::max('price');

        $filter_min_price = $request->filter_min_price;
        $filter_max_price = $request->filter_max_price;
        
        $priceOrderBy = $request->order_by_price ?: 'ASC';

        if($filter_min_price && $filter_max_price){
            $packages = DB::table('packages')
                ->selectRaw("packages.*, users.name as user, users.phone_number as phone, CONCAT_WS(' ', address_1, address_2, city, state, zipcode) as address")
                ->join('users', 'packages.user_id', 'users.id')
                ->where('packages.deleted_at', NULL)
                ->whereBetween('packages.price', [$filter_min_price, $filter_max_price])
                ->orderBy('packages.price', $priceOrderBy)
                ->paginate(2);
        }else{
            $packages = DB::table('packages')
                ->selectRaw("packages.*, users.name as user, users.phone_number as phone, CONCAT_WS(' ', address_1, address_2, city, state, zipcode) as address")
                ->join('users', 'packages.user_id', 'users.id')
                ->where('packages.deleted_at', NULL)
                ->orderBy('packages.price', $priceOrderBy)
                ->paginate(2);
        }            

        $items = Item::all();
        $categoryRules = DB::table('category_rules')
            ->selectRaw("category_rules.*, categories.name as category_name")
            ->join('categories', 'category_rules.category_id', '=', 'categories.id')
            ->get();

        return view('store', compact(['packages', 'items', 'categoryRules', 'max_price', 'min_price', 'filter_min_price', 'filter_max_price', 'priceOrderBy']));
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $package = Package::selectRaw("packages.*, users.name as user, users.phone_number as phone, CONCAT_WS(' ', address_1, address_2, city, state, zipcode) as address")
            ->join('users', 'packages.user_id', 'users.id')
            ->where('packages.id', $id)
            ->get();

        $items = Item::where('user_id', $package[0]->user_id)->get();

        $categoryRules = CategoryRule::select('category_rules.*', 'categories.name as category_name')
            ->join('categories', 'category_rules.category_id', 'categories.id')
            ->where('package_id', $package[0]->id)
            ->where('category_rules.deleted_at', NULL)
            ->get();


        return view('product', compact(['package', 'items', 'categoryRules']));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
