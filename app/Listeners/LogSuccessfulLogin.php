<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Log;

class LogSuccessfulLogin
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
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $logs = new Log;
        $logs->user_id = $event->user->id;
        $logs->description = 'account access';
        $logs->ip_address = \Request::ip();
        $logs->action = 'login';
        $logs->created_at = Carbon::now();
        $logs->save();

        $event->user->status = true;
        $event->user->last_sign_in_at = $event->user->current_sign_in_at ? $event->user->current_sign_in_at : Carbon::now();
        $event->user->current_sign_in_at = Carbon::now();
        $event->user->save();
    }
}

// last_sign_in_at = current_sign_in at ? current_sign_in_at : time ngayon.
