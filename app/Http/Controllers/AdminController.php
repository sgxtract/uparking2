<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserUpdate;
use App\Http\Requests\AddVehicle;
use Carbon\Carbon;
use App\Log;
use App\User;
use App\Vehicle;
use App\Wallet;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('checkRole:admin');
        $this->middleware('auth');
    }
    
    public function dashboard(){
        return view('admin.dashboard');
    }

    public function vehicles(){
        $vehicle = Vehicle::paginate(5);
        return view('admin.vehicles')->with('vehicles', $vehicle);
    }

    public function addVehicle($id){

        return $id;
        $vehicle = new Vehicle;
        $vehicle->user_id = Auth::user()->id;
        $vehicle->plate_number = strtoupper($request['plate_number']);
        $vehicle->type = $request['type'];
        $vehicle->created_at = Carbon::now();
        $vehicle->save();

        // Post To Logs
        // $logs = new Log;
        // $logs->user_id = Auth::user()->id;
        // $logs->description = 'added a vehicle | Plate no. : ' . strtoupper($request['plate_number']) . ' | Type: ' . $request['type'];
        // $logs->ip_address = \Request::ip();
        // $logs->action = 'registered a vehicle';
        // $logs->created_at = Carbon::now();
        // $logs->save();

        return back()->with('success', 'Vehicle added successfully.');
    }

    public function removeVehicle($id){
        $vehicle = Vehicle::where('id', $id)->first();
        $vehicle->delete();

        // Post To Logs
        $logs = new Log;
        $logs->user_id = Auth::user()->id;
        $logs->description = 'admin removed vehicle';
        $logs->ip_address = \Request::ip();
        $logs->action = 'removed vehicle';
        $logs->created_at = Carbon::now();
        $logs->save();

        return back()->with('success2', 'Vehicle removed successfully.');
    }

    public function history(){
        $logs = Log::paginate(5);
        return view('admin.history')->with('logs', $logs);
    }

    public function users(){
        $users = User::paginate(5);
        return view('admin.users')->with('users', $users);
    }

    public function singleUser($id){
        $user = User::findOrFail($id);
        return view('admin.singleUser')->with('user', $user);
    }

    public function newUser(){
        return view('admin.addUser');
    }

    public function addNewUser(UserUpdate $request){
        $user = new User;
        $user->name = $request['name'];
        $user->last_name = $request['last_name'];
        $user->email = $request['email'];
        $user->phone_number = $request['phone_number'];
        $user->created_at = Carbon::now();

        $validation = $request->validate([
            'password' => 'required|string|min:6|confirmed',
            'phone_number' => 'required|numeric|digits:11|unique:users'
        ]);

        $user->password = bcrypt($request['password']);

        if($request['staff']){
            $user->staff = true;
        }else{
            $user->staff = false;
        }
        
        if($request['admin']){
            $user->admin = true;
        }else{
            $user->admin = false;
        }

        $user->save();

        $wallet = new Wallet;
        $wallet->user_id = $user->id;
        $wallet->balance = 0.00;
        $wallet->status = true;
        $wallet->save();

        return back()->with('success', 'New user successfully created.');
    }

    public function editUser($id){
        $user = User::where('id', $id)->first();
        return view('admin.editUser')->with('user', $user);
    }

    public function editUserAccount(Request $request, $id){
        $user = User::where('id', $id)->first();
        $user->name = $request['name'];
        $user->last_name = $request['last_name'];
        $user->email = $request['email'];
        $user->phone_number = $request['phone_number'];
        $user->updated_at = Carbon::now();

        if($request['staff']){
            $user->staff = true;
        }else{
            $user->staff = false;
        }
        
        if($request['admin']){
            $user->admin = true;
        }else{
            $user->admin = false;
        }

        $user->save();

        // Post To Logs
        $logs = new Log;
        $logs->user_id = Auth::user()->id;
        $logs->description = 'Admin Changes | ' . $user->name . ' ' . $user->last_name . ' Account';
        $logs->ip_address = \Request::ip();
        $logs->action = 'edited user account';
        $logs->created_at = Carbon::now();
        $logs->save();

        return back()->with('success', 'User updated successfully.');
    }

    public function deleteUser($id){
        $user = User::where('id', $id)->first();
        $wallet = Wallet::where('user_id', $id)->first();
        if($user->admin){
            return back()->with('error', 'This user of type admin cannot be deleted.');
        }
        $user->delete();
        $wallet->delete();
        $vehicle = Vehicle::where('user_id', $id)->delete();

        return back();
    }
}
