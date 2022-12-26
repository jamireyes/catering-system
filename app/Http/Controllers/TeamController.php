<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Team;
use App\Models\Member;
use App\Models\Order;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Auth;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == 'SELLER'){
            $teams = Team::select('id', 'order_id', 'deleted_at')->withTrashed()->get();
            $members = Member::select('id', 'team_id', 'name', 'role', 'deleted_at')->withTrashed()->get();
        }elseif(Auth::user()->role == 'USER'){

        }

        return view('pages.teams.index', compact(['teams', 'members']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
        ]);

        try {
            $order = Order::findOrFail($request->order_id);
        } catch(ModelNotFoundException $e) {
            return back()->with('error', 'Record not found');
        }

        $team = new Team;
        $team->order_id = $request->order_id;
        $team->save();

        $message = 'Successfully created a new team for Order #'.$request->order_id;

        return back()->with('success', $message);
    }

    public function destroy(Team $team)
    {
        $team->delete();

        return back()->with('warning', 'Successfully removed team');
    }

    public function restore($id)
    {
        $team = Team::withTrashed()->find($id);
        $team->restore();

        return back()->with('warning', 'Successfully restored team');
    }
}
