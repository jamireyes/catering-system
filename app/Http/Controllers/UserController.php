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
                        $status = '<span class="badge badge-pill badge-info p-2">ADMIN</span>';
                    }elseif($row->role == 'USER'){
                        $status = '<span class="badge badge-pill badge-success p-2">USER</span>';
                    }elseif($row->role == 'SELLER'){
                        $status = '<span class="badge badge-pill badge-danger p-2">SELLER</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function($row){
                    if($row->deleted_at == NULL){
                        $btn = '<button id="delete-btn" class="btn btn-sm btn-outline-danger btn-round" data-id="'.$row->id.'" href="#">Delete</button>';
                    }else{
                        $btn = '<button id="restore-btn" class="btn btn-sm btn-outline-info btn-round" data-id="'.$row->id.'" href="#">Restore</button>';
                    }
                    return $btn;
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
