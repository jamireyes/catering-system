<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SellerDocuments;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Response as FacadeResponse;
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
                            $status = '<span class="badge badge-pill badge-success p-2">CUSTOMER</span>';
                        }elseif($row->role == 'SELLER'){
                            $status = '<span class="badge badge-pill badge-danger p-2">SELLER</span>';
                        }
                        return $status;
                    })
                    ->addColumn('document', function($row){
                        $btn = '<div class="d-flex justify-content-center align-items-center">';
                        if($row->role == 'SELLER') {
                            $docs = SellerDocuments::where('user_id', $row->id)->limit(2)->get();
                            foreach($docs as $doc){
                                $btn .= '<form action="'.route('user.show', ['user' => $doc->id]).'">
                                            <button type="submit" id="document-btn" class="text-secondary">
                                                <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2.7" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                            </button>
                                        </form>';
                            }
                            $btn .= '</div>';
                        }

                        return $btn;
                    })
                    ->addColumn('action', function($row){
                        if($row->deleted_at == NULL){
                            $btn = '<a id="delete-btn" class="text-danger" data-id="'.$row->id.'" href="#" title="Delete">
                                        <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                                    </a>';
                        }else{
                            $btn = '<a id="restore-btn" class="text-info" data-id="'.$row->id.'" href="#" title="Restore">
                                        <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="1 4 1 10 7 10"></polyline><polyline points="23 20 23 14 17 14"></polyline><path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path></svg>
                                    </a>';
                        }
                        return $btn;
                    })
                    ->addColumn('live', function($row){
                        if($row->role == 'SELLER'){
                            if($row->live_date == NULL){
                                $btn = '<a id="live-enable-btn" class="text-secondary" data-id="'.$row->id.'" href="#" title="Click to make user LIVE">
                                            <i class="fa-solid fa-toggle-off"></i>
                                        </a>';
                            }else{
                                $btn = '<a id="live-disable-btn" class="text-success" data-id="'.$row->id.'" href="#" title="Click to make user NOT LIVE">
                                            <i class="fa-solid fa-toggle-on"></i>
                                        </a>';
                            }
                        }else{
                            $btn = '';
                        }
                        return $btn;
                    })
                    ->rawColumns(['role', 'document', 'action', 'live'])
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
            'name' => 'required',
            'password' => 'required',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required|unique:users',
            'address_1' => 'required',
            'address_2' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zipcode' => 'required',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->password = $request->password;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->role = $request->role;
        $user->address_1 = $request->address_1;
        $user->address_2 = $request->address_2;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->zipcode = $request->zipcode;
        $user->save();

        if(request()->hasFile('file')){
            foreach(request()->file as $file){
                $path = Storage::disk('spaces')->putFileAs('seller_documents', $file, $file->hashName());

                $docs = new SellerDocuments;
                $docs->user_id = $user->id;
                $docs->file = $path;
                $docs->mime_type = $file->getMimeType();
                $docs->save();
            }
        }

        $message = 'Successfully created an account for '.$request->name.'!';
        
        return redirect()->route('user.index')->with('success', $message);
    }

    public function show($id)
    {
        $docs = SellerDocuments::find($id);

        return Storage::disk('spaces')->download($docs->file);
    }

    public function update(Request $request, $id)
    {   
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'address_1' => 'required',
            'address_2' => 'required',
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

    public function toggleLive($id)
    {
        $user = User::find($id);

        if($user->live_date == NULL){
            $user->live_date = now();
            $user->save();
        }elseif($user->live_date != NULL){
            $user->live_date = NULL;
            $user->save();
        }

        // return ($user->live_date == NULL) ? 'DEACTIVATED' : 'ACTIVATED';
    }
}
