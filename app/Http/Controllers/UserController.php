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
use App\User;
use Carbon\Carbon;
use Hash;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function dashboard(){
        $vehicles = Vehicle::where('user_id', Auth::user()->id)->get();
        $reserves = Reserve::where('user_id', Auth::user()->id)->get();
        $user = User::where('id', Auth::user()->id)->first();
        return view('user.dashboard')->with(['vehicles' => $vehicles, 'reserves' => $reserves, 'user' => $user]);
    }

    public function profile(){
        return view('user.profile');
    }

    public function profilePost(UserUpdate $request){
        $user = Auth::user();

        // Edit Profile
        $user->name = $request['name'];
        $user->last_name = $request['last_name'];
        $user->email = $request['email'];
        $user->phone_number = $request['phone_number'];
        $user->updated_at = Carbon::now();
        $user->save();

        // Change Password
        if($request['password'] != ""){
            if(!(Hash::check($request['password'], Auth::user()->password))){
                return redirect()->back()->with('error', 'Your current password does not match with the password you provided.');
            }

            if(!(strcmp($request['password'], $request['new_password']))){
                return redirect()->back()->with('error', 'New password cannot be same as your current password.');
            }

            $validation = $request->validate([
                'password' => 'required',
                'new_password' => 'required|string|min:6|confirmed',
            ]);

            $user->password = bcrypt($request['new_password']);
            $user->save();

            // Post To Logs
            $logs = new Log;
            $logs->user_id = Auth::user()->id;
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

    public function addVehicle(AddVehicle $request){
        $vehicle = new Vehicle;
        $vehicle->user_id = Auth::user()->id;
        $vehicle->plate_number = strtoupper($request['plate_number']);
        $vehicle->type = $request['type'];
        $vehicle->created_at = Carbon::now();
        $vehicle->save();

        // Post To Logs
        $logs = new Log;
        $logs->user_id = Auth::user()->id;
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
        $logs->description = 'updated vehicle information';
        $logs->ip_address = \Request::ip();
        $logs->action = 'update vehicle';
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
        $logs->description = 'user vehicle';
        $logs->ip_address = \Request::ip();
        $logs->action = 'removed vehicle';
        $logs->created_at = Carbon::now();
        $logs->save();

        return back()->with('success2', 'Vehicle removed successfully.');
    }

    public function balance(){
        $wallet = Wallet::where('user_id', Auth::user()->id)->first();
        return view('user.balance')->with('wallet', $wallet);
    }

    public function history(){
        $logs = Log::orderBy('created_at')->where('user_id', Auth::user()->id)->paginate(5);
        return view('user.history')->with('logs', $logs);
    }

    public function reserve(){
        $user = Auth::user()->id;
        return view('user.reserve')->with('user', $user);
    }

    public function reserveSlot(Request $request, $id){

        // User Wallet
        $wallet = Wallet::where('user_id', $id)->first();
        $plate_number = strtoupper($request['plate_number']);
        $slot_number = $request['slot_number'];
        $vehicle = Vehicle::where('user_id', $id)->get();

        $add_funds = "Add Funds " . "<a href='".route('userBalance')."'>here.</a>";

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
    
                    return back()->with('success', "Reserved a vehicle with Plate Number : $plate_number at Slot Number : $slot_number");
                }
            }
        }

    }
}
