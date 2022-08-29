<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Category;
use App\Models\Item;
use Auth;
use DB;

class PageController extends Controller
{
    public function homepage()
    {
        $packages = DB::table('packages')
            ->selectRaw("packages.*, users.name as user, users.phone_number as phone, CONCAT_WS(' ', address_1, address_2, city, state, zipcode) as address")
            ->join('users', 'packages.user_id', 'users.id')
            ->where('packages.deleted_at', NULL)
            ->inRandomOrder()
            ->limit(3)
            ->get();

        $items = Item::all();
        $categoryRules = DB::table('category_rules')
            ->selectRaw("category_rules.*, categories.name as category_name")
            ->join('categories', 'category_rules.category_id', '=', 'categories.id')
            ->get();

        return view('welcome', compact(['packages', 'items', 'categoryRules']));
    }
}
