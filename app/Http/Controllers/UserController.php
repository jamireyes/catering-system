<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Exception;
use Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if(Auth::user()->role == 'ADMIN'){
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
                            $btn = '<a id="delete-btn" class="text-danger" data-id="'.$row->id.'" href="#">
                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                                    </a>';
                        }else{
                            $btn = '<a id="restore-btn" class="text-info" data-id="'.$row->id.'" href="#">
                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="1 4 1 10 7 10"></polyline><polyline points="23 20 23 14 17 14"></polyline><path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path></svg>
                                    </a>';
                        }
                        return $btn;
                    })
                    ->rawColumns(['role', 'action'])
                    ->make(true);
            }
            
            return view('pages.users.index');
        }

        return back();
    }

    public function create()
    {
        return view('pages.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|unique:users',
            'address_1' => 'required|string|max:255',
            'address_2' => 'required|string|max:255',
            'city' => 'required',
            'state' => 'required',
            'zipcode' => 'required',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->address_1 = $request->address_1;
        $user->address_2 = $request->address_2;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->zipcode = $request->zipcode;
        $user->save();

        $message = 'Successfully created an account for '.$request->name.'!';
        
        return redirect()->route('user')->with('success', $message);
    }

    public function update(Request $request, $id)
    {   
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|unique:users',
            'address_1' => 'required|string|max:255',
            'address_2' => 'required|string|max:255',
            'city' => 'required',
            'state' => 'required',
            'zipcode' => 'required',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->address_1 = $request->address_1;
        $user->address_2 = $request->address_2;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->zipcode = $request->zipcode;
        $user->save();
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
