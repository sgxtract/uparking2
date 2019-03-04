<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Log;
use App\User;
class LogSuccessfulLogout
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
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        $type = User::where('id', $event->user->id)->first();
        $logs = new Log;
        $logs->user_id = $event->user->id;
        if($type->admin == true){
            $logs->type = 'admin';
        }else if($type->staff == true){
            $logs->type = 'staff';
        }else{
            $logs->type = 'user';
        }
        $logs->description = 'account access';
        $logs->ip_address = \Request::ip();
        $logs->action = 'logout';
        $logs->created_at = Carbon::now();
        $logs->save();

        $event->user->status = false;
        $event->user->save();
    }
}
