<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Log;
use App\Reserve;

class StaffController extends Controller
{
    public function __construct(){
        $this->middleware('checkRole:staff');
        $this->middleware('auth');
    }

    public function dashboard(){
        $occupied = Reserve::where('status', 'occupied')->get();
        $reserves = Reserve::where('status', 'reserved')->get();
        $free = Reserve::where('status', 'free')->get();
        return view('staff.dashboard')->with(['occupied' => $occupied, 'reserves' => $reserves, 'free' => $free]);
    }

    public function history(){
        $logs = Log::orderBy('created_at')->where('user_id', Auth::user()->id)->paginate(5);
        return view('staff.history')->with('logs', $logs);
    }

    public function walkIn(){
        $slots = Reserve::all();
        return view('staff.walkin')->with('slots', $slots);
    }

    public function reserve(){
        return view('staff.reserve');
    }

    public function checkIn(){
        return view('staff.checkin');
    }

    public function checkOut(){
        return view('staff.checkout');
    }
}
