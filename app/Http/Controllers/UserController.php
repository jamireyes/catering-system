<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// use App\DataTables\UsersDataTable;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */   

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('users')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('role', function($row){
                    if($row->role == 'ADMIN'){
                        $status = '<span class="badge badge-info p-2">ADMIN</span>';
                    }elseif($row->role == 'USER'){
                        $status = '<span class="badge badge-success p-2">USER</span>';
                    }elseif($row->role == 'SELLER'){
                        $status = '<span class="badge badge-danger p-2">SELLER</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function($row){
                    return '<div class="dropdown">
                                <button class="btn btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="nc-icon nc-bullet-list-67"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <button class="dropdown-item edit-btn" data-id="'.$row->id.'" href="#">Edit</button>
                                    <button id="delete-btn" class="dropdown-item" data-id="'.$row->id.'" href="#">Delete</button>
                                </div>
                            </div>';
                })
                ->rawColumns(['role', 'action'])
                ->make(true);
        }
        
        return view('pages.users.index');
    }

    public function create()
    {
        return view('pages.users.create');
    }

    public function store(Request $request)
    {
        User::create($request->all());
        
        return back()->withStatus(__('Successfully added a new user!'));
    }

    public function destroy($id)
    {
        $user = User::find($id)->delete();
    }

    public function restore($id)
    {
        $user = User::withTrashed()->find($id)->restore();
    }
}
