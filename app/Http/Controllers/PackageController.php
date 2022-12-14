<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Category;
use App\Models\Item;
use App\Models\Occasion;
use App\Models\CategoryRule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Auth;
use DB;

class PackageController extends Controller
{
    public function __construct(){
        $this->rules = [
            'name' => 'required',
            'pax' => 'required',
            'cost_price' => 'required',
            'price' => 'required',
            'category' => 'required',
            'quantity' => 'required',
            'inclusion' => 'required',
            'occasion' => 'required'
        ];
        $this->messages = [
            'name.required' => 'The package name field is required.',
            'pax.required' => 'The pax field is required.',
            'cost_price.required' => 'The cost price field is required.',
            'price.required' => 'The selling price field is required.',
            'category.required' => 'The category field is required.',
            'quantity.required' => 'The quantity field is required.',
            'inclusion.required' => 'The inclusion field is required.',
            'occasion.required' => 'The occasion field is required.'
        ];
    }

    // Displays the packages
    public function index()
    {
        if(Auth::user()->role == 'USER'){
            return back();
        }

        $package_query = DB::table('packages')
            ->selectRaw("packages.*, users.name as user, users.phone_number as phone, CONCAT_WS(' ', address_1, address_2, city, state, zipcode) as address")
            ->join('users', 'packages.user_id', 'users.id');
            
        
        $categoryRule_query = DB::table('category_rules')
            ->select('category_rules.*', 'categories.name as category_name')
            ->join('categories', 'category_rules.category_id', '=', 'categories.id');
            

        if(Auth::user()->role == 'ADMIN'){
            $packages = $package_query->paginate(8);
            $items = Item::all();
            $categoryRules = $categoryRule_query->get();
        }else{
            $packages = $package_query->where('user_id', Auth::id())
                ->where('packages.deleted_at', NULL)
                ->paginate(8);
            $items = Item::where('user_id', Auth::id())->get();
            $categoryRules = $categoryRule_query->join('packages', 'category_rules.package_id', '=', 'packages.id')
                ->where('packages.user_id', Auth::id())
                ->where('category_rules.deleted_at', NULL)
                ->get();
        }

        return view('pages.packages.index', compact(['packages', 'categoryRules', 'items']));
    }

    // Show the add package page
    public function create()
    {
        $categories = Category::where('user_id', Auth::id())->get();
        $occasions = Occasion::select('id', 'name')->get();

        if($categories->isEmpty()){
            $message = 'No inventory records found! Kindly go to the INVENTORY page and add inventory items';
            session()->now('error', $message);
        }

        return view('pages.packages.create', compact(['categories', 'occasions']));
    }

    // Creates new packages
    public function store(Request $request)
    {
        $request->validate($this->rules, $this->messages);

        // Stores the package name, pax, and price
        $package = new Package;
        $package->user_id = Auth::id();
        $package->name = $request->name;
        $package->pax = $request->pax;
        $package->cost_price = $request->cost_price;
        $package->price = $request->price;
        $package->inclusion = $request->inclusion;
        $package->occasion_id = $request->occasion;
        $package->discount = $request->discount;
        $package->save();
        
        // Stores the package categories with set limit per category
        for ($x = 0; $x < count($request->category); $x++) {
            if($request->quantity[$x] != 0){
                $categoryRule = new CategoryRule;
                $categoryRule->category_id = $request->category[$x];
                $categoryRule->package_id = $package->id;
                $categoryRule->quantity = $request->quantity[$x];
                $categoryRule->save();
            }
        }

        $message = 'Successfully added '.$request->name.'!';

        return redirect()->route('package.index')->with('success', $message);
    }

    // 
    public function show(Package $package)
    {
        //
    }

    // Shows the edit package page
    public function edit($id)
    {

        if(Auth::user()->role != 'ADMIN'){
            $packages = DB::table('packages')
                ->select('packages.*')
                ->where('packages.id', $id)
                ->where('packages.user_id', Auth::id())
                ->get();
        }else{
            $packages = DB::table('packages')
                ->select('packages.*')
                ->where('packages.id', $id)
                ->get();
        }

        $occasions = Occasion::select('id', 'name')->get();
        $categories = DB::table('categories')
            ->select('categories.id', 'categories.name', 'category_rules.quantity')
            ->join('category_rules', 'categories.id', 'category_rules.category_id')
            ->where('category_rules.package_id', '=', $id)
            ->get();

        return view('pages.packages.edit', compact(['packages', 'categories', 'occasions']));
    }

    // Updates packages
    public function update(Request $request, $id)
    {
        $request->validate($this->rules, $this->messages);
        
        // Updates the package name, pax, and price
        $package = Package::find($id);
        if(Auth::user()->role != 'ADMIN'){
            $package->user_id = Auth::id(); 
        }
        $package->name = $request->name;
        $package->pax = $request->pax;
        $package->cost_price = $request->cost_price;
        $package->price = $request->price;
        $package->inclusion = $request->inclusion;
        $package->occasion_id = $request->occasion;
        $package->discount = $request->discount;
        $package->save();
        
        // Updates the package categories with set limit per category
        for ($x = 0; $x < count($request->category); $x++) {
            if($request->quantity[$x] != 0){
                $categoryRule = DB::table('category_rules')
                    ->where('package_id', $id)
                    ->where('category_id', $request->category[$x])
                    ->update(['quantity' => $request->quantity[$x]]);
            }else{
                $categoryRule = DB::table('category_rules')
                    ->where('package_id', $id)
                    ->where('category_id', $request->category[$x])
                    ->update(['deleted_at' => Carbon::now()]);
            }
        }

        $message = 'Successfully added '.$request->name.'!';

        return redirect()->route('package.index')->with('success', $message);
    }

    // Soft deletes packages
    public function destroy($id)
    {
        $package = Package::find($id);
        $category_rules = CategoryRule::where('package_id', $id)->delete();
        $package->delete(); 

        $message = 'Successfully deleted '.$package->name.'!';

        return back()->with('info', $message);
    }

    // Restores packages
    public function restore($id)
    {
        $package = Package::withTrashed()->find($id);
        $category_rules = CategoryRule::withTrashed()->where('package_id', $id)->restore();
        $package->restore();

        $message = 'Successfully restored '.$package->name.'!';

        return back()->with('info', $message);
    }
}
