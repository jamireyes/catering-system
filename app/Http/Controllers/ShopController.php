<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\CategoryRule;
use App\Models\Category;
use App\Models\Item;
use App\Models\Occasion;
use App\Models\Favorite;
use Auth;
use DB;
use Session;

class ShopController extends Controller
{
   
    public function index(Request $request)
    {
        $min_price = Package::min('price');
        $max_price = Package::max('price');

        $query = Package::selectRaw("packages.*, users.name as user, users.phone_number as phone, CONCAT_WS(' ', address_1, address_2, city, state, zipcode) as address")
            ->join('users', 'packages.user_id', 'users.id')
            ->where('packages.deleted_at', NULL);

        if($request->filter_min_price && $request->filter_max_price){
            $query = $query->whereBetween('packages.price', [$request->filter_min_price, $request->filter_max_price]);
        }

        if($request->order_by_price){
            $query = $query->orderBy('packages.price', $request->order_by_price);
        }else{
            $query = $query->orderBy('packages.price', 'ASC');
        }

        if($request->filter_occasion){
            $query = $query->where('occasion_id', $request->filter_occasion);
        }

        $packages = $query->paginate(8);         

        $items = Item::all();
        $categoryRules = DB::table('category_rules')
            ->selectRaw("category_rules.*, categories.name as category_name")
            ->join('categories', 'category_rules.category_id', '=', 'categories.id')
            ->get();
        $occasions = Occasion::select('id', 'name')
            ->where('deleted_at', NULL)
            ->get();
        

        return view('store', compact([
            'packages', 
            'items', 
            'categoryRules', 
            'occasions',
            'max_price', 
            'min_price'
        ]));
    }

    public function show($id)
    {
        $package = Package::selectRaw("
                packages.*, 
                users.name as user, 
                users.phone_number as phone,
                users.email as email,
                users.id as cater_id,
                CONCAT_WS(' ', address_1, address_2, city, state, zipcode) as address
            ")
            ->join('users', 'packages.user_id', 'users.id')
            ->where('packages.id', $id)
            ->get();

        $items = Item::where('user_id', $package[0]->user_id)->get();

        $categoryRules = CategoryRule::select('category_rules.*', 'categories.name as category_name')
            ->join('categories', 'category_rules.category_id', 'categories.id')
            ->where('package_id', $package[0]->id)
            ->where('category_rules.deleted_at', NULL)
            ->get();

        $favorite = Favorite::where('user_id', Auth::id())
            ->where('package_id', $id)
            ->first();
        // dd($favorite);

        return view('product', compact(['package', 'items', 'categoryRules', 'favorite']));
    }

    public function search(Request $request) 
    {
        if($request->ajax()){
            $query = Package::where('name', 'like', '%'.$request->search.'%')->get();
        }

        return response()->json($query);
    }
}
