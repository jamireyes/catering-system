<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use Auth;

class CategoryController extends Controller
{

    public function __construct(){
        $this->rules = [
            'name' => 'required',
        ];
        $this->messages = [
            'name.required' => 'The category name field is required.',
        ];
    }

    public function index()
    {
        if(Auth::user()->role == 'ADMIN'){
            $categories = DB::table('categories')
                ->select('categories.*', 'users.name as user')
                ->join('users', 'categories.user_id', '=', 'users.id')
                ->paginate(10);

        }elseif(Auth::user()->role == 'SELLER'){
            $categories = DB::table('categories')
                ->where('user_id', Auth::id())
                ->paginate(10);
        }else{
            back();
        }

        return view('pages.category.index', compact('categories'));
    }

    // Store a newly created category.
    public function store(Request $request)
    {   
        $request->validate($this->rules, $this->messages);

        $category = new Category;
        $category->name = $request->name;
        $category->user_id = Auth::id();
        $category->save();
        
        $message = 'Successfully added '.$request->name.'!';

        return back()->with('success', $message);
    }

    public function edit($category)
    {   
        $category = Category::find($category);

        return view('pages.category.edit', compact('category'));
    }

    // Update the specified category.
    public function update(Request $request, $id)
    {
        $request->validate($this->rules, $this->messages);

        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();
        
        $message = 'Successfully updated '.$request->name.'!';

        return redirect()->route('category.index')->with('success', $message);
    }

    // Remove the specified category.
    public function destroy($id)
    {   

        $category = Category::find($id);
        $category->delete();

        $message = 'Successfully deleted '.$category->name.'!';

        return back()->with('warning', $message);
    }

    // Restore the specified category.
    public function restore($id)
    {
        $category = Category::withTrashed()->find($id);
        $category->restore();

        $message = 'Successfully restored '.$category->name.'!';

        return back()->with('warning', $message);
    }
}
