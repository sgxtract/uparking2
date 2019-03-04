<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserUpdate;
use App\Http\Requests\AddVehicle;
use App\Log;
use App\Vehicle;
use App\Wallet;
use App\Reserve;
use App\Reserve_Log;
use App\User;
use Carbon\Carbon;
use Hash;
use Response;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function dashboard(){
        $vehicles = Vehicle::where('user_id', Auth::user()->id)->get();
        $reserves = Reserve::where('user_id', Auth::user()->id)->get();
        $reserves2 = Reserve::where(['user_id' => Auth::user()->id, 'status' => 'reserved'])->get();
        $user = User::where('id', Auth::user()->id)->first();
        return view('user.dashboard')->with(['vehicles' => $vehicles, 'reserves' => $reserves, 'user' => $user, 'reserves2' => $reserves2]);
    }

    public function profile(){
        return view('user.profile');
    }

    public function profilePost(Request $request){
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone_number' => 'required|numeric|digits:11',
        ]);

        // Edit Profile
        $user->name = strip_tags($request['name']);
        $user->last_name = strip_tags($request['last_name']);
        $user->email = strip_tags($request['email']);
        $user->phone_number = strip_tags($request['phone_number']);
        $user->updated_at = Carbon::now();
        $user->save();

        // Change Password
        if($request['password'] != ""){
            if(!(sha1(strip_tags($request['password']), Auth::user()->password))){
                return redirect()->back()->with('error', 'Your current password does not match with the password you provided.');
            }

            if(!(strcmp(strip_tags($request['password']), strip_tags($request['new_password'])))){
                return redirect()->back()->with('error', 'New password cannot be same as your current password.');
            }

            $validation = $request->validate([
                'password' => 'required',
                'new_password' => 'required|string|min:6|confirmed',
            ]);

            $user->password = sha1(strip_tags($request['new_password']));
            $user->save();

            // Post To Logs
            $logs = new Log;
            $logs->user_id = Auth::user()->id;
            $logs->type = "user";
            $logs->description = 'user profile #'. $user->id . ' | ' . $user->name . ' ' . $user->last_name;
            $logs->ip_address = \Request::ip();
            $logs->action = 'changed password';
            $logs->created_at = Carbon::now();
            $logs->save();

            return redirect()->back()->with('success', 'Password changed successfully!');
        }

        // Post To Logs
        $logs = new Log;
        $logs->user_id = Auth::user()->id;
        $logs->type = "user";
        $logs->description = 'user profile #'. $user->id . ' | ' . $user->name . ' ' . $user->last_name;
        $logs->ip_address = \Request::ip();
        $logs->action = 'edited profile';
        $logs->created_at = Carbon::now();
        $logs->save();

        return redirect()->back()->with('success', 'Profile edited successfully.');
    }

    public function vehicles(){
        $vehicles = Vehicle::where('user_id', Auth::user()->id)->get();
        return view('user.vehicle')->with('vehicles', $vehicles);
    }

    public function addVehicle(Request $request){
        
        $validation = $request->validate([
            'plate_number' => 'required|alpha_num|unique:vehicles',
            'type' => 'required',
        ]);

        $vehicle = new Vehicle;
        $vehicle->user_id = Auth::user()->id;
        $vehicle->plate_number = strtoupper($request['plate_number']);
        $vehicle->type = $request['type'];
        $vehicle->created_at = Carbon::now();
        $vehicle->save();

        // Post To Logs
        $logs = new Log;
        $logs->user_id = Auth::user()->id;
        $logs->type = "user";
        $logs->description = 'added a vehicle | Plate no. : ' . strtoupper($request['plate_number']) . ' | Type: ' . $request['type'];
        $logs->ip_address = \Request::ip();
        $logs->action = 'registered a vehicle';
        $logs->created_at = Carbon::now();
        $logs->save();

        return back()->with('success', 'Vehicle added successfully.');
    }

    public function editVehicle($id){
        $vehicle = Vehicle::where('id', $id)->first();
        return view('user.editVehicle')->with('vehicle', $vehicle);
    }

    public function editVehicleInfo(AddVehicle $request, $id){
        $vehicle = Vehicle::where('id', $id)->first();
        $vehicle->plate_number = strtoupper($request['plate_number']);
        $vehicle->type = $request['type'];
        $vehicle->updated_at = Carbon::now();
        $vehicle->save();

        // Post To Logs
        $logs = new Log;
        $logs->user_id = Auth::user()->id;
        $logs->type = "user";
        $logs->description = 'updated vehicle information';
        $logs->ip_address = \Request::ip();
        $logs->action = 'update';
        $logs->created_at = Carbon::now();
        $logs->save();

        return back()->with('success', 'Vehicle information updated successfully.');
    }

    public function removeVehicle($id){
        $vehicle = Vehicle::where('id', $id)->first();
        $vehicle->delete();

        // Post To Logs
        $logs = new Log;
        $logs->user_id = Auth::user()->id;
        $logs->type = 'user';
        $logs->description = 'removed a vehicle';
        $logs->ip_address = \Request::ip();
        $logs->action = 'removed';
        $logs->created_at = Carbon::now();
        $logs->save();

        return back()->with('success2', 'Vehicle removed successfully.');
    }

    public function balance(){
        $wallet = Wallet::where('user_id', Auth::user()->id)->first();
        return view('user.balance')->with('wallet', $wallet);
    }

    public function history(){
        $logs = Log::where('user_id', Auth::user()->id)->get();
        $reserve_logs = Reserve_Log::where('user_id', Auth::user()->id)->get();
        return view('user.history')->with(['logs' => $logs, 'reserve_logs' => $reserve_logs]);
    }

    public function reserve(){
        $user = Auth::user()->id;
        $occupied = Reserve::where('status', 'occupied')->get();
        $reserves = Reserve::where('status', 'reserved')->get();
        $free = Reserve::where('status', 'free')->get();
        $vehicles = Vehicle::where('user_id', $user)->get();
        return view('user.reserve')->with(['occupied' => $occupied, 'reserves' => $reserves, 'free' => $free, 'user' => $user, 'vehicles' => $vehicles]);
    }

    public function reserveSlot(Request $request, $id){
        
        // User Wallet
        $wallet = Wallet::where('user_id', $id)->first();
        $plate_number = strtoupper($request['plate_number']);
        $slot_number = strip_tags($request['slot_number']);
        $vehicle = Vehicle::where('user_id', $id)->get();

        $add_funds = "Add Funds " . "<a href='".route('userBalance')."'>here.</a>";

        $validation = $request->validate([
            'plate_number' => 'required|unique:reserves|alpha_num|min:6',
        ]);

        if($vehicle->isEmpty()){
            return back()->with('error', "No registered vehicle found. Register at least one (1) vehicle to reserve a slot.");
        }else{
            if($wallet->user_id == $id){
                if($wallet->balance < 100){
                    return back()->with('error', "Balance not enough, must have a minimum of ₱ 100 load. $add_funds");
                }
                else{
                    
                    $reserve = Reserve::where('slot_number', $slot_number)->first();
                    $reserve->user_id = $id;
                    $reserve->plate_number = $plate_number;
                    $reserve->slot_number = $slot_number;
                    $reserve->status = 'reserved';
                    $reserve->walk_in = false;
                    $reserve->created_at = Carbon::now();
                    $reserve->save();
    
                    $wallet->balance -= 50;
                    $wallet->save();

                    // Reserve Logs
                    $reserve_logs = new Reserve_Log;
                    $reserve_logs->user_id = $id;
                    $reserve_logs->slot_number = $slot_number;
                    $reserve_logs->plate_number = $plate_number;
                    $reserve_logs->walk_in = false;
                    $reserve_logs->payment = 50;
                    $reserve_logs->created_at = Carbon::now();
                    $reserve_logs->save();

                    // Vehicle Status
                    $vehicleUpdate = Vehicle::where('plate_number', $plate_number)->first();
                    $vehicleUpdate->status = 'reserved';
                    $vehicleUpdate->save();

                    // Post To Logs
                    $logs = new Log;
                    $logs->user_id = Auth::user()->id;
                    $logs->type = 'user';
                    $logs->description = "made a reservation @ $slot_number";
                    $logs->ip_address = \Request::ip();
                    $logs->action = 'reserved';
                    $logs->created_at = Carbon::now();
                    $logs->save();
    
                    return back()->with('success', "Reserved a vehicle with Plate Number : $plate_number at Slot Number : $slot_number");
                }
            }
        }

    }

    public function cancelReserve($slot_number){
        $cancel = Reserve::where('slot_number', $slot_number)->first();
        
        // Vehicle Status
        $vehicle = Vehicle::where('plate_number', $cancel->plate_number)->first();
        $vehicle->status = 'free';
        $vehicle->save();

        // Update Slot
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
        $logs->type = 'user';
        $logs->description = "cancelled a reservation @ $slot_number";
        $logs->ip_address = \Request::ip();
        $logs->action = 'cancel';
        $logs->created_at = Carbon::now();
        $logs->save();

        return redirect(route('userDashboard'))->with('success', 'You cancelled your reservation.');
    }
}
