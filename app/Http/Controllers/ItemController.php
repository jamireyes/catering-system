<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use Auth;
use DB;

class ItemController extends Controller
{
    public function __construct(){
        $this->rules = [
            'category_id' => 'required',
            'name' => [
                'required', 
                Rule::unique('items', 'name')->where(fn ($query) => $query->where('user_id', Auth::id()))
            ],
            'description' => 'required'
        ];
        $this->messages = [
            'category_id.required' => 'The category field is required.',
            'name.required' => 'The item name field is required.',
            'description.required' => 'The item description field is required.'
        ];
    }

    // Displays all the data for both the categories and items
    public function index(Request $request)
    {
        if(Auth::user()->role == 'USER'){
            return back();
        }

        if(Auth::user()->role == 'ADMIN'){
            $query = DB::table('items')
                ->select('items.*', 'categories.name as category_name', 'users.name as user')
                ->join('categories', 'items.category_id', '=', 'categories.id')
                ->join('users', 'items.user_id', '=', 'users.id');
                
                
        }elseif(Auth::user()->role == 'SELLER'){
            $query = DB::table('items')
                ->join('categories', 'items.category_id', '=', 'categories.id')
                ->select('items.*', 'categories.name as category_name')
                ->where('items.user_id', Auth::id());
        }

        if($request->active == 'true'){
            $query = $query->where('items.deleted_at', NULL);
        }

        if($request->inactive == 'true'){
            $query = $query->where('items.deleted_at', '!=', NULL);
        }

        if(!$request->has('active') && !$request->has('inactive')){
            $query = $query->where('items.deleted_at', NULL);
        }

        $items = $query->paginate(10);

        return view('pages.item.index', compact('items'));
    }

    // Shows the create item page
    public function create()
    {   
        $category = Category::where('user_id', Auth::id())->get();

        return view('pages.item.create', compact('category'));
    }

    // Creates a new item
    public function store(Request $request)
    {
        $request->validate($this->rules, $this->messages);

        $item = new Item;
        $item->name = $request->name;
        $item->description = $request->description;
        $item->category_id = $request->category_id;
        $item->user_id = Auth::id();
        $item->save();
        
        $message = 'Successfully added '.$request->name.'!';

        return redirect()->route('item.index')->with('success', $message);
    }

    // Shows the edit item page
    public function edit($id)
    {
        $item = Item::find($id);
        
        $category = Category::where('user_id', $item->user_id)->get();

        return view('pages.item.edit', compact(['item', 'category']));
    }

    // Update the item
    public function update(Request $request, $id)
    {
        $request->validate($this->rules, $this->messages);

        $item = Item::find($id);
        $item->name = $request->name;
        $item->description = $request->description;
        $item->category_id = $request->category_id;
        $item->user_id = Auth::id();
        $item->save();
        
        $message = 'Successfully added '.$request->name.'!';

        return redirect()->route('item.index')->with('success', $message);
    }

    // Soft deletes the item
    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();

        $message = 'Successfully deleted '.$item->name.'!';

        return back()->with('success', $message);
    }

    // Restores the item
    public function restore($id)
    {
        $item = Item::withTrashed()->find($id);
        $item->restore();

        $message = 'Successfully restored '.$item->name.'!';

        return back()->with('success', $message);
    }
}
