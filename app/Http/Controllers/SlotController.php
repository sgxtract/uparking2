<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reserve;
use Carbon\Carbon;

class SlotController extends Controller
{
    // For Walk In
    public function checkIn(Request $request){

        $plate_number = strtoupper($request['plate_number']);
        $slot_number = $request['slot_number'];

        $reserve = Reserve::where('slot_number', $slot_number)->first();
        $reserve->user_id = '0';
        $reserve->plate_number = $plate_number;
        $reserve->status = 'occupied';
        $reserve->walk_in = true;
        $reserve->created_at = Carbon::now();
        $reserve->save();

        return back()->with('success', "Checked In Vehicle : $plate_number at Slot Number : $slot_number");
    }

    // For Reserve
    public function reserve(Request $request){

        $plate_number = strtoupper($request['plate_number']);
        $slot_number = $request['slot_number'];

        $reserve = Reserve::where('slot_number', $slot_number)->first();
        $reserve->user_id = '0';
        $reserve->plate_number = $plate_number;
        $reserve->status = 'reserved';
        $reserve->walk_in = true;
        $reserve->created_at = Carbon::now();
        $reserve->save();

        return back()->with('success', "Reserved a vehicle with Plate Number : $plate_number at Slot Number : $slot_number");
    }
}
