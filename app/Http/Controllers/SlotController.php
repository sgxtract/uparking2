<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reserve;
use App\User;
use App\Wallet;
use App\Vehicle;
use Carbon\Carbon;

class SlotController extends Controller
{
    // For Walk In
    public function checkIn(Request $request){

        $plate_number = strip_tags(strtoupper($request['plate_number']));
        $slot_number = $request['slot_number'];
        $reserve = Reserve::where('slot_number', $slot_number)->first();
        $vehicle = Vehicle::where('plate_number', $plate_number)->first();

        if($vehicle){
            $reserve->user_id = $vehicle->user_id;
            $reserve->plate_number = $plate_number;
            $reserve->status = 'occupied';
            $reserve->walk_in = true;
            $reserve->created_at = Carbon::now();
            $reserve->save();
        }else{
            $reserve->user_id = '0';
            $reserve->plate_number = $plate_number;
            $reserve->status = 'occupied';
            $reserve->walk_in = true;
            $reserve->created_at = Carbon::now();
            $reserve->save();
        }

        return back()->with('success', "Checked In Vehicle : $plate_number at Slot Number : $slot_number");
    }

    // For Reserve
    public function reserve(Request $request){

        $plate_number = strip_tags(strtoupper($request['plate_number']));
        $slot_number = $request['slot_number'];

        $vehicle = Vehicle::where('plate_number', $plate_number)->first();
        $reserve = Reserve::where('slot_number', $slot_number)->first();

        return $vehicle;

        if($vehicle){
            $reserve->user_id = $vehicle->user_id;
            $reserve->plate_number = $plate_number;
            $reserve->status = 'reserved';
            $reserve->walk_in = true;
            $reserve->created_at = Carbon::now();
            $reserve->save();
        }else{
            $reserve->user_id = '0';
            $reserve->plate_number = $plate_number;
            $reserve->status = 'reserved';
            $reserve->walk_in = true;
            $reserve->created_at = Carbon::now();
            $reserve->save();
        }

        return back()->with('success', "Reserved a vehicle with Plate Number : $plate_number at Slot Number : $slot_number");
    }

    // Check In
    public function checkInSearch(Request $request){

        $plate_number = strip_tags(strtoupper($request['plate_number']));
        $vehicle = Vehicle::where('plate_number', $plate_number)->first();
        $check_in = Reserve::where('plate_number', $plate_number)->first();

        $validation = $request->validate([
            'plate_number' => 'required|alpha_num|min:6',
        ]);

        if($check_in){
            if($vehicle){
                $user = User::where('id', $check_in->user_id)->first();
                $wallet = Wallet::where('user_id', $user->id)->first();
                return view('staff.checkin_results')->with(['check_in' => $check_in, 'user' => $user, 'wallet' => $wallet]);
            }else{
                return view('staff.checkin_results2')->with('check_in', $check_in);
            }
        }else{
            return back()->with('error', 'There is no reservation found for ' . $plate_number);
        }

    }

    public function checkInReserve($slot){
        $check_in = Reserve::where('slot_number', $slot)->first();
        $check_in->status = 'occupied';
        $check_in->save();

        return redirect(route('staffCheckIn'))->with('success', 'Successfully checked in ' . $check_in->plate_number);
    }

    // Check Out
    public function checkOutSearch(Request $request){

        $plate_number = strip_tags(strtoupper($request['plate_number']));

        $check_out = Reserve::where('plate_number', $plate_number)->first();

        $startTime = strtotime($check_out['created_at']);
        $endTime = strtotime($check_out['updated_at']);
        $totalTime = $endTime - $startTime;

        $validation = $request->validate([
            'plate_number' => 'required|alpha_num|min:6',
        ]);

        if($check_out){
            $check_out->updated_at = Carbon::now();
            $check_out->save();

            if(!($check_out->walk_in)){
                if($totalTime <= 7200){
                    $toPay = 0;
                }else{
                    $newStartTime = $startTime + 7200; // New Time For Reservee
                    $newTotalTime = $endTime - $newStartTime;
                    $newTotalTime /= 3600;
                    if($newTotalTime < 1){
                        $toPay = floor($newTotalTime + 1) * 25;
                    }else{
                        $toPay = round($newTotalTime) * 25;
                    }
                }
            }else{
                if($totalTime <= 7200){
                    $toPay = 50;
                }else{
                    $toPay = round($totalTime/3600) * 25;
                }
            }
    
            $totalTime /= 3600;
    
            return view('staff.checkout_results')->with(['check_out' => $check_out, 'totalTime' => $totalTime, 'toPay' => $toPay]);
        }else{
            return back()->with('error', 'Could not find ' . $plate_number . '. <br/> Please check and try again.');
        }

    }
    
    public function checkOut($slot){
        $check_out = Reserve::where('slot_number', $slot)->first();
        $check_out->user_id = 0;
        $check_out->plate_number = ' ';
        $check_out->status = 'free';
        $check_out->save();

        return redirect(route('staffCheckOut'))->with('success', 'Successfully checked out.');
    }
}
