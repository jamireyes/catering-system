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
            $orders = Order::select('orders.id as order_id', 'packages.name as package_name', 'users.name as customer')
                ->join('packages', 'orders.package_id', 'packages.id')
                ->join('users', 'orders.user_id', 'users.id')
                ->where('packages.user_id', Auth::id())
                ->get();
            $teams = Team::select('id', 'order_id', 'deleted_at')
                ->whereIn('order_id', $orders->pluck('order_id'))
                ->withTrashed()
                ->get();
            $members = Member::select('id', 'team_id', 'name', 'role', 'deleted_at')
                ->whereIn('team_id', $teams->pluck('id'))
                ->withTrashed()->get();
        }

        return view('pages.teams.index', compact(['teams', 'members', 'orders']));
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
            $order = Order::join('packages', 'orders.package_id', 'packages.id')
                ->where('orders.id', $request->order_id)
                ->where('packages.user_id', Auth::id())
                ->firstOrFail();
        } catch(ModelNotFoundException $e) {
            return back()->with('error', 'Record not found!');
        }

        try {
            if(Team::where('order_id', $request->order_id)->first() != NULL){
                throw new ModelNotFoundException;
            }
        } catch(ModelNotFoundException $e) {
            return back()->with('error', 'There is an existing team!');
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
