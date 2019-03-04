<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Reserve;
use App\Reserve_Log;
use App\User;
use App\Log;
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
        $user_type = User::where('id', Auth::user()->id)->first();

        $validation = $request->validate([
            'plate_number' => 'required|unique:reserves|alpha_num|min:6',
        ]);

        if($vehicle){
            $reserve->user_id = $vehicle->user_id;
            $reserve->plate_number = $plate_number;
            $reserve->status = 'occupied';
            $reserve->walk_in = true;
            $reserve->created_at = Carbon::now();
            $reserve->save();

            // Reserve Logs
            $reserve_logs = new Reserve_Log;
            $reserve_logs->user_id = $vehicle->user_id;
            $reserve_logs->slot_number = $slot_number;
            $reserve_logs->plate_number = $plate_number;
            $reserve_logs->walk_in = true;
            $reserve_logs->payment = 0;
            $reserve_logs->created_at = Carbon::now();
            $reserve_logs->save();

            // Post To Logs
            if($user_type->admin == true){
                $logs = new Log;
                $logs->user_id = Auth::user()->id;
                $logs->type = 'admin';
                $logs->description = "checked-in $plate_number @ $slot_number";
                $logs->ip_address = \Request::ip();
                $logs->action = 'checked-in';
                $logs->created_at = Carbon::now();
                $logs->save();
            }else{
                $logs = new Log;
                $logs->user_id = Auth::user()->id;
                $logs->type = 'staff';
                $logs->description = "checked-in $plate_number @ $slot_number";
                $logs->ip_address = \Request::ip();
                $logs->action = 'checked-in';
                $logs->created_at = Carbon::now();
                $logs->save();
            }
            
        }else{
            $reserve->user_id = '0';
            $reserve->plate_number = $plate_number;
            $reserve->status = 'occupied';
            $reserve->walk_in = true;
            $reserve->created_at = Carbon::now();
            $reserve->save();

            // Reserve Logs
            $reserve_logs = new Reserve_Log;
            $reserve_logs->user_id = '0';
            $reserve_logs->slot_number = $slot_number;
            $reserve_logs->plate_number = $plate_number;
            $reserve_logs->walk_in = true;
            $reserve_logs->payment = 0;
            $reserve_logs->created_at = Carbon::now();
            $reserve_logs->save();

            // Post To Logs
            if($user_type->admin == true){
                $logs = new Log;
                $logs->user_id = Auth::user()->id;
                $logs->type = 'admin';
                $logs->description = "checked-in $plate_number @ $slot_number";
                $logs->ip_address = \Request::ip();
                $logs->action = 'checked-in';
                $logs->created_at = Carbon::now();
                $logs->save();
            }else{
                $logs = new Log;
                $logs->user_id = Auth::user()->id;
                $logs->type = 'staff';
                $logs->description = "checked-in $plate_number @ $slot_number";
                $logs->ip_address = \Request::ip();
                $logs->action = 'checked-in';
                $logs->created_at = Carbon::now();
                $logs->save();
            }
        }

        return back()->with('success', "Checked In Vehicle (Walk-In) : $plate_number at Slot Number : $slot_number");
    }

    // For Reserve
    public function reserve(Request $request){

        $plate_number = strip_tags(strtoupper($request['plate_number']));
        $slot_number = $request['slot_number'];

        $vehicle = Vehicle::where('plate_number', $plate_number)->first();
        $reserve = Reserve::where('slot_number', $slot_number)->first();
        $user_type = User::where('id', Auth::user()->id)->first();

        $validation = $request->validate([
            'plate_number' => 'required|unique:reserves|alpha_num|min:6',
        ]);
        
        if($vehicle){
            $reserve->user_id = $vehicle->user_id;
            $reserve->plate_number = $plate_number;
            $reserve->status = 'reserved';
            $reserve->walk_in = true;
            $reserve->created_at = Carbon::now();
            $reserve->save();

            // Reserve Logs
            $reserve_logs = new Reserve_Log;
            $reserve_logs->user_id = $vehicle->user_id;
            $reserve_logs->slot_number = $slot_number;
            $reserve_logs->plate_number = $plate_number;
            $reserve_logs->walk_in = true;
            $reserve_logs->payment = 50;
            $reserve_logs->created_at = Carbon::now();
            $reserve_logs->save();

            // Vehicle Status
            $vehicle->status = 'reserved';
            $vehicle->save();

            // Post To Logs
            if($user_type->admin == true){
                $logs = new Log;
                $logs->user_id = Auth::user()->id;
                $logs->type = 'admin';
                $logs->description = "reserved vehicle | $plate_number @ $slot_number";
                $logs->ip_address = \Request::ip();
                $logs->action = 'reserved';
                $logs->created_at = Carbon::now();
                $logs->save();
            }else{
                $logs = new Log;
                $logs->user_id = Auth::user()->id;
                $logs->type = 'staff';
                $logs->description = "reserved vehicle | $plate_number @ $slot_number";
                $logs->ip_address = \Request::ip();
                $logs->action = 'reserved';
                $logs->created_at = Carbon::now();
                $logs->save();
            }
        }else{
            $reserve->user_id = '0';
            $reserve->plate_number = $plate_number;
            $reserve->status = 'reserved';
            $reserve->walk_in = true;
            $reserve->created_at = Carbon::now();
            $reserve->save();

            // Reserve Logs
            $reserve_logs = new Reserve_Log;
            $reserve_logs->user_id = '0';
            $reserve_logs->slot_number = $slot_number;
            $reserve_logs->plate_number = $plate_number;
            $reserve_logs->walk_in = true;
            $reserve_logs->payment = 50;
            $reserve_logs->created_at = Carbon::now();
            $reserve_logs->save();

            // Post To Logs
            if($user_type->admin == true){
                $logs = new Log;
                $logs->user_id = Auth::user()->id;
                $logs->type = 'admin';
                $logs->description = "reserved vehicle | $plate_number @ $slot_number";
                $logs->ip_address = \Request::ip();
                $logs->action = 'reserved';
                $logs->created_at = Carbon::now();
                $logs->save();
            }else{
                $logs = new Log;
                $logs->user_id = Auth::user()->id;
                $logs->type = 'staff';
                $logs->description = "reserved vehicle | $plate_number @ $slot_number";
                $logs->ip_address = \Request::ip();
                $logs->action = 'reserved';
                $logs->created_at = Carbon::now();
                $logs->save();
            }
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

        if(!$check_in){
            return back()->with('error', 'There is no reservation found for ' . $plate_number);
        }else{
            if($plate_number == $check_in->plate_number && $check_in->status == 'reserved'){
                if($check_in){
                    if($vehicle){
                        $user = User::where('id', $check_in->user_id)->first();
                        $wallet = Wallet::where('user_id', $user->id)->first();
                        return view('staff.checkin_results')->with(['check_in' => $check_in, 'user' => $user, 'wallet' => $wallet, 'vehicle' => $vehicle]);
                    }else{
                        return view('staff.checkin_results2')->with('check_in', $check_in);
                    }
                }else{
                    return back()->with('error', 'There is no reservation found for ' . $plate_number);
                }
            }else{
                return back()->with('error', 'Plate number ' . $plate_number . ' is already checked in.');
            }
        }   

        
    }

    // Check In Reserve
    public function checkInReserve($slot){
        $check_in = Reserve::where('slot_number', $slot)->first();
        $user_type = User::where('id', Auth::user()->id)->first();
        $plate_number = $check_in->plate_number;

        if($check_in->user_id == 0){
            $check_in->status = 'occupied';
            $check_in->save();

            // Post To Logs
            if($user_type->admin == true){
                $logs = new Log;
                $logs->user_id = Auth::user()->id;
                $logs->type = 'admin';
                $logs->description = "checked-in reserved | $plate_number @ $slot";
                $logs->ip_address = \Request::ip();
                $logs->action = 'checked-in reserved';
                $logs->created_at = Carbon::now();
                $logs->save();
            }else{
                $logs = new Log;
                $logs->user_id = Auth::user()->id;
                $logs->type = 'staff';
                $logs->description = "checked-in reserved | $plate_number @ $slot";
                $logs->ip_address = \Request::ip();
                $logs->action = 'checked-in reserved';
                $logs->created_at = Carbon::now();
                $logs->save();
            }
        }else{
            $check_in->status = 'occupied';
            $check_in->save();

            // Vehicle Status
            $vehicle = Vehicle::where('plate_number', $check_in->plate_number)->first();
            $vehicle->status = 'occupied';
            $vehicle->save();

            // Post To Logs
            if($user_type->admin == true){
                $logs = new Log;
                $logs->user_id = Auth::user()->id;
                $logs->type = 'admin';
                $logs->description = "checked-in reserved | $plate_number @ $slot";
                $logs->ip_address = \Request::ip();
                $logs->action = 'checked-in reserved';
                $logs->created_at = Carbon::now();
                $logs->save();
            }else{
                $logs = new Log;
                $logs->user_id = Auth::user()->id;
                $logs->type = 'staff';
                $logs->description = "checked-in reserved | $plate_number @ $slot";
                $logs->ip_address = \Request::ip();
                $logs->action = 'checked-in reserved';
                $logs->created_at = Carbon::now();
                $logs->save();
            }
        }

        

        return redirect(route('staffCheckIn'))->with('success', 'Successfully checked in ' . $check_in->plate_number);
    }

    // Check Out by Plate Number
    public function checkOutSearch(Request $request){

        $plate_number = strip_tags(strtoupper($request['plate_number']));

        $check_out = Reserve::where('plate_number', $plate_number)->first();

        $startTime = strtotime($check_out['created_at']);
        $endTime = strtotime($check_out['updated_at']);
        $totalTime = $endTime - $startTime;

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
    
            return view('staff.checkout_results')->with(['check_out' => $check_out, 'totalTime' => $totalTime, 'toPay' => $toPay, 'user_id' => $check_out->user_id]);
        }else{
            return back()->with('error', 'Could not find ' . $plate_number . '. <br/> Please check and try again.');
        }

    }

    // Check Out by Slot Number
    public function checkOutSearch2(Request $request){

        $slot_number = strip_tags($request['slot_number']);

        $check_out = Reserve::where('slot_number', $slot_number)->first();

        $startTime = strtotime($check_out['created_at']);
        $endTime = strtotime($check_out['updated_at']);
        $totalTime = $endTime - $startTime;

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
    
            return view('staff.checkout_results')->with(['check_out' => $check_out, 'totalTime' => $totalTime, 'toPay' => $toPay, 'user_id' => $check_out->user_id]);
        }else{
            return back()->with('error', 'Could not find ' . $slot_number . '. <br/> Please check and try again.');
        }

    }
    
    // Pay with cash
    public function checkOut($slot){
        $check_out = Reserve::where('slot_number', $slot)->first();
        $user_type = User::where('id', Auth::user()->id)->first();
        $plate_number = $check_out->plate_number;
        
        if($check_out->status == 'reserved'){
            return redirect(route('staffCheckOut'))->with('error', "Cannot check out plate number $check_out->plate_number. <br/> It is not yet checked in.");
        }else{

            // Vehicle Status
            $vehicle = Vehicle::where('plate_number', $check_out->plate_number)->first();
            $vehicle->status = 'free';
            $vehicle->save();

            // Update Slot
            $check_out->user_id = 0;
            $check_out->plate_number = ' ';
            $check_out->status = 'free';
            $check_out->save();

            // Update Time Out
            $reserve_logs = Reserve_Log::where(['created_at' => $check_out->created_at, 'slot_number' => $slot])->first();
            $reserve_logs->updated_at = Carbon::now();
            $reserve_logs->save();

            // Post To Logs
            if($user_type->admin == true){
                $logs = new Log;
                $logs->user_id = Auth::user()->id;
                $logs->type = 'admin';
                $logs->description = "checked-out | $plate_number @ $slot";
                $logs->ip_address = \Request::ip();
                $logs->action = 'checked-out';
                $logs->created_at = Carbon::now();
                $logs->save();
            }else{
                $logs = new Log;
                $logs->user_id = Auth::user()->id;
                $logs->type = 'staff';
                $logs->description = "checked-out | $plate_number @ $slot";
                $logs->ip_address = \Request::ip();
                $logs->action = 'checked-out';
                $logs->created_at = Carbon::now();
                $logs->save();
            }
            
            return redirect(route('staffCheckOut'))->with('success', 'Successfully checked out.');
        }
    }

    // Pay with wallet
    public function checkOut2($slot, $id, $toPay){
        $wallet = Wallet::where('user_id', $id)->first();
        if($wallet){
            if($wallet->balance < $toPay){
                return redirect(route('staffCheckOut'))->with('error', 'Insufficient load balance.');
            }else{
                $wallet->balance -= $toPay;
                $wallet->save();

                // Update Slot
                $check_out = Reserve::where('slot_number', $slot)->first();
                $check_out->user_id = 0;
                $check_out->plate_number = ' ';
                $check_out->status = 'free';
                $check_out->save();

                // Update Check Out Logs
                $reserve_logs = Reserve_Log::where(['created_at' => $check_out->created_at, 'slot_number' => $slot])->first();
                $reserve_logs->payment += $toPay;
                $reserve_logs->updated_at = Carbon::now();
                $reserve_logs->save();

                // Post To Logs
                if($user_type->admin == true){
                    $logs = new Log;
                    $logs->user_id = Auth::user()->id;
                    $logs->type = 'admin';
                    $logs->description = "checked-out | $plate_number @ $slot";
                    $logs->ip_address = \Request::ip();
                    $logs->action = 'checked-out';
                    $logs->created_at = Carbon::now();
                    $logs->save();
                }else{
                    $logs = new Log;
                    $logs->user_id = Auth::user()->id;
                    $logs->type = 'staff';
                    $logs->description = "checked-out | $plate_number @ $slot";
                    $logs->ip_address = \Request::ip();
                    $logs->action = 'checked-out';
                    $logs->created_at = Carbon::now();
                    $logs->save();
                }

                return redirect(route('staffCheckOut'))->with('success', "Vehicle at <strong>$slot</strong> has successfully checked out.");
            }
        }else{
            return redirect(route('staffCheckOut'))->with('error', 'This customer don\'t have an online wallet.');
        }
    }
}
