<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reserve;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function reserve(){
        $slots = Reserve::all();
        return view('staff.reserve')->with('slots', $slots);
    }

    public function checkIn(Request $request){
        $reserve = new Reserve;
        $reserve->user_id = '0';
        $reserve->slot_number = 'Slot 52';
        $reserve->plate_number = $request['plate_number'];
        $reserve->status = 'occupied';
        $reserve->created_at = Carbon::now();
        $reserve->save();

        return back();
    }
}