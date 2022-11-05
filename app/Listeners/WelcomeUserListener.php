<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\WelcomeUser;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Notification;
use Auth;

class WelcomeUserListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Verified $event)
    {
        Notification::send($event->user, new WelcomeUser($event->user));
    }
}
