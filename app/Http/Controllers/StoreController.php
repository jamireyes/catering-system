<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Package;
use App\Models\Category;
use App\Models\CategoryRule;
use App\Models\Item;
use App\Models\Feedback;

class StoreController extends Controller
{

    public function index()
    {
        $stores = User::where('role', 'SELLER')
            ->paginate(12);

        return view('pages.stores.index', compact(['stores']));  
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Request $request, $id)
    {
        $store = User::where('id', $id)->get();

        if($store[0]->role == 'USER') {
            abort(404);
        }

        $avg_rating = number_format(Feedback::avg('rating'), 1, '.', ',');
        $ratings = Feedback::selectRaw('Count(rating) as total_rating, rating')
            ->groupBy('rating')
            ->orderBy('rating', 'desc')
            ->get();

        $temp = collect($ratings->toArray());

        for($x = 1; $x < 6; $x++){
            if(!$temp->contains('rating', $x)){
                $temp->push(['total_rating' => 0, 'rating' => $x]);
            }
        }

        $ratings = $temp->sortByDesc('rating');

        $min_price = Package::min('price');
        $max_price = Package::max('price');

        $items = Item::where('user_id', $id)->get();

        $query = Package::selectRaw("packages.*, users.name as user, users.phone_number as phone, CONCAT_WS(' ', address_1, address_2, city, state, zipcode) as address")
            ->join('users', 'packages.user_id', 'users.id')
            ->join('occasions', 'packages.occasion_id', 'occasions.id')
            ->where('users.id', $id)
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

        $packages = $query->paginate(6);

        $categoryRules = CategoryRule::selectRaw("category_rules.*, categories.name as category_name")
            ->join('categories', 'category_rules.category_id', '=', 'categories.id')
            ->whereIn('package_id', $packages->pluck('id')->toArray())
            ->get();

        return view('pages.stores.show', compact([
            'store',
            'packages', 
            'items', 
            'categoryRules',
            'max_price', 
            'min_price',
            'avg_rating',
            'ratings'
        ]));
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
