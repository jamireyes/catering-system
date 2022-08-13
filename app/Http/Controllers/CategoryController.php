<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;

class CategoryController extends Controller
{
    // Store a newly created category.
    public function store(Request $request)
    {   
        $request->validate([
            'name' => 'required|string|unique:categories',
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->user_id = Auth::id();
        $category->save();
        
        $message = 'Successfully added '.$request->name.'!';

        return back()->with('success', $message);
    }

    // Update the specified category.
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|unique:category',
        ]);

        $category = Category::find($id);
        $category->name = $request->category_name;
        $category->user_id = Auth::id();
        $category->save();
        
        $message = 'Successfully added '.$request->category_name.'!';

        return back()->with('success', $message);
    }

    // Remove the specified category.
    public function destroy($id)
    {   

        $category = Category::find($id);
        $category->delete();

        $message = 'Successfully DELETED '.$category->name.'!';

        return back()->with('success', $message);
    }

    // Restore the specified category.
    public function restore($id)
    {
        $category = Category::withTrashed()->find($id);
        $category->restore();

        $message = 'Successfully RESTORED '.$category->name.'!';

        return back()->with('success', $message);
    }
}
