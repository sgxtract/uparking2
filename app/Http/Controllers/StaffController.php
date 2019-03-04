<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Log;
use App\User;
use App\Reserve;
use App\Wallet;
use App\Vehicle;
use App\Reserve_Log;
use Carbon\Carbon;

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
        $logs = Log::where('user_id', Auth::user()->id);
        return view('staff.history')->with('logs', $logs);
    }

    public function walkIn(){
        $slots = Reserve::all();
        return view('staff.walkin')->with('slots', $slots);
    }

    public function reservesView(){
        $reserves = Reserve::where('status', 'reserved')->get();
        return view('staff.reserves_view')->with('reserves', $reserves);
    }

    public function reserve(){
        return view('staff.reserve');
    }

    public function cancelReserve($slot_number){
        $cancel = Reserve::where('slot_number', $slot_number)->first();
        $plate_number = $cancel->plate_number;

        if($cancel->user_id == 0){
            // Update Slots
            $cancel->user_id = 0;
            $cancel->plate_number = ' ';
            $cancel->status = 'free';
            $cancel->save();

            // Update Time Out and Payment.
            $reserve_logs = Reserve_Log::where(['created_at' => $cancel->created_at, 'slot_number' => $slot_number])->first();
            $reserve_logs->updated_at = Carbon::now();
            $reserve_logs->save();

            // Post To Logs
            $logs = new Log;
            $logs->user_id = Auth::user()->id;
            $logs->type = 'staff';
            $logs->description = "cancelled reservation for $plate_number";
            $logs->ip_address = \Request::ip();
            $logs->action = 'cancel';
            $logs->created_at = Carbon::now();
            $logs->save();

            return redirect(route('staffDashboard'))->with('success', "Reservation for $plate_number has successfully cancelled.");
        }else{
            // Update Slots
            $cancel->user_id = 0;
            $cancel->plate_number = ' ';
            $cancel->status = 'free';
            $cancel->save();

            // Vehicle Status
            $vehicle = Vehicle::where('plate_number', $cancel->plate_number)->first();
            $vehicle->status = 'free';
            $vehicle->save();

            // Update Time Out and Payment.
            $reserve_logs = Reserve_Log::where(['created_at' => $cancel->created_at, 'slot_number' => $slot_number])->first();
            $reserve_logs->updated_at = Carbon::now();
            $reserve_logs->save();

            // Post To Logs
            $logs = new Log;
            $logs->user_id = Auth::user()->id;
            $logs->type = 'staff';
            $logs->description = "cancelled reservation for $plate_number";
            $logs->ip_address = \Request::ip();
            $logs->action = 'cancel';
            $logs->created_at = Carbon::now();
            $logs->save();

            return redirect(route('staffDashboard'))->with('success', "Reservation for $vehicle->plate_number has successfully cancelled.");
        }
    }

    public function checkIn(){
        $vehicles = Reserve::where('status', 'reserved')->get();
        return view('staff.checkin')->with('vehicles', $vehicles);
    }

    public function checkOut(){
        $vehicles = Reserve::where('status', 'occupied')->get();
        return view('staff.checkout')->with('vehicles', $vehicles);
    }

    public function addFunds(){
        $users = User::all();
        $wallets = Wallet::all();
        return view('staff.add_funds')->with(['users' => $users, 'wallets' => $wallets]);
    }

    public function continueUserFunds(Request $request, $id){
        $user = User::where('id', $id)->first();
        $wallet = Wallet::where('user_id', $id)->first();
        return view('staff.add_funds_results')->with(['id' => $id, 'user' => $user, 'wallet' => $wallet]);
    }
}
