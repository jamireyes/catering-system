<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Occasion;
use Illuminate\Support\Str;
use DB;

class OccasionController extends Controller
{
    public function index()
    {
        $occasions = Occasion::withTrashed()->paginate(10);

        return view('pages.occasion.index', compact('occasions'));
    }

    public function create()
    {
        return view('pages.occasion.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:occasions',
            'occasion' => 'required|unique:occasions,name'
        ]);

        $occasion = new Occasion;
        $occasion->name = Str::upper($request->name|$request->occasion);
        $occasion->save();

        $message = 'Successfully added '.Str::upper($request->name).'!';

        return back()->with('success', $message);
    }

    public function edit($id)
    {   
        $occasion = Occasion::find($id);

        return view('pages.occasion.edit', compact('occasion'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:occasions'
        ]);

        $occasion = Occasion::find($id);
        $occasion->name = Str::upper($request->name);
        $occasion->save();

        $message = 'Successfully added '.Str::upper($request->name).'!';

        return back()->with('success', $message);
    }

    public function destroy($id)
    {
        $occasion = Occasion::find($id);
        $occasion->delete();

        $message = 'Successfully deleted '.$occasion->name.'!';

        return back()->with('warning', $message);
    }

    public function restore($id)
    {
        $occasion = Occasion::withTrashed()->find($id);
        $occasion->restore();

        $message = 'Successfully restored '.$occasion->name.'!';

        return back()->with('warning', $message);
    }
}
