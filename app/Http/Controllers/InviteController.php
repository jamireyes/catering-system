<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Junges\InviteCodes\Facades\InviteCodes;
use Illuminate\Broadcasting\Channel;
use App\Notifications\SendAdminInvite;
use Notification;

class InviteController extends Controller
{
    public function showInviteRegistration() 
    {
        return view('auth.invite-register');
    }
    
    public function generateInvite(Request $request) 
    {
        $invite_code = InviteCodes::create()
            ->expiresIn(30)
            ->maxUsages(10)
            ->restrictUsageTo($request->email)
            ->save();

        Notification::route('mail', $invite_code->to)->notify(new SendAdminInvite($invite_code));

        return back()->with('status', 'Invitation sent!');
    }

    public function store(Request $request)
    {
        // if()
    }
}
