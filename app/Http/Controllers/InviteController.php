<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Junges\InviteCodes\Facades\InviteCodes;
use Illuminate\Broadcasting\Channel;
use App\Notifications\SendAdminInvite;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use Carbon\Carbon;
use Notification;
use Auth;
use DB;

class InviteController extends Controller
{
    public function showInviteRegistration() 
    {
        if(Auth::check()){
            abort(404);
        }

        return view('auth.invite-register');
    }
    
    public function generateInvite(Request $request) 
    {
        $request->validate([
            'email_invitation' => 'required|email'
        ]);

        $invite_code = InviteCodes::create()
            ->expiresIn(30)
            ->maxUsages(10)
            ->restrictUsageTo($request->email_invitation)
            ->save();

        Notification::route('mail', $invite_code->to)->notify(new SendAdminInvite($invite_code));

        return back()->with('status', 'Invitation sent!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => [
                'required',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ],
            'email' => 'required|email|unique:users',
            'password_confirmation' => 'required|same:password',
        ]);

        if(!isset($request->code)){
            return back()->with('error', 'No invitational code!');
        }

        $code = DB::table('invites')
            ->where('code', $request->code)
            ->where('deleted_at', NULL)
            ->exists();
            
        if($code == FALSE) {
            return back()->with('error', 'Invitational code does not exist!');
        }  

        DB::table('invites')
            ->where('code', $request->code)
            ->update(['deleted_at' => Carbon::now()]);

        $user = new User;
        $user->name = $request->name;
        $user->password = $request->password;
        $user->email = $request->email;
        $user->role = 'ADMIN';
        $user->save();

        Auth::loginUsingId($user->id);

        return redirect()->route('home');
    }
}
