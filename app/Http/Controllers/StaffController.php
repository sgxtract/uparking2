<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Log;

class StaffController extends Controller
{
    public function __construct(){
        $this->middleware('checkRole:staff');
        $this->middleware('auth');
    }

    public function dashboard(){
        return view('staff.dashboard');
    }

    public function history(){
        $logs = Log::orderBy('created_at')->where('user_id', Auth::user()->id)->paginate(5);
        return view('staff.history')->with('logs', $logs);
    }

    public function walkIn(){
        return view('staff.walkin');
    }

    public function checkIn(){
        return view('staff.checkin');
    }

    public function checkOut(){
        return view('staff.checkout');
    }
}
