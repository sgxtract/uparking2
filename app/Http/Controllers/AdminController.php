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
use App\Reserve;
use App\Reserve_Log;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('checkRole:admin');
        $this->middleware('auth');
    }
    
    public function dashboard(){
        return view('admin.dashboard');
    }

    public function salesReport(){
        $logs = Reserve_log::all();
        $payment = 0;
        foreach($logs as $log){
            $payment += $log->payment;
        }
        return view('admin.sales_report')->with('payment', $payment);
    }

    public function statisticsReport(){
        $reserves = Reserve_Log::all();
        $users = User::all();
        $vehicles = Vehicle::all();
        return view('admin.statistics_report')->with(['reserves' => $reserves, 'users' => $users, 'vehicles' => $vehicles]);
    }

    public function vehicles(){
        $vehicle = Vehicle::all();
        return view('admin.vehicles')->with('vehicles', $vehicle);
    }

    // Not use
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
        $logs->type = 'admin';
        $logs->description = 'admin removed vehicle';
        $logs->ip_address = \Request::ip();
        $logs->action = 'removed';
        $logs->created_at = Carbon::now();
        $logs->save();

        return back()->with('success2', 'Vehicle removed successfully.');
    }

    // History Logs
    public function userLogs(){
        $logs = Log::all();
        return view('admin.logs.user-logs')->with('logs', $logs);
    }

    public function staffLogs(){
        $logs = Log::where('type', 'staff')->get();
        return view('admin.logs.staff-logs')->with('logs', $logs);
    }

    public function parkingLogs(){
        $logs = Reserve_Log::all();
        return view('admin.logs.parking-logs')->with('logs', $logs);
    }
    // End History Logs

    public function users(){
        $users = User::all();
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
        $user->name = strip_tags($request['name']);
        $user->last_name = strip_tags($request['last_name']);
        $user->email = strip_tags($request['email']);
        $user->phone_number = strip_tags($request['phone_number']);
        $user->created_at = Carbon::now();
        $user->email_verified_at = Carbon::now();

        $validation = $request->validate([
            'password' => 'required|string|min:6|confirmed',
            'phone_number' => 'required|numeric|digits:11|unique:users'
        ]);

        $user->password = sha1($request['password']);

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

        // Post To Logs
        $email = strip_tags($request['email']);
        $logs = new Log;
        $logs->user_id = Auth::user()->id;
        $logs->type = 'admin';
        $logs->description = "created new user | email: $email";
        $logs->ip_address = \Request::ip();
        $logs->action = 'create';
        $logs->created_at = Carbon::now();
        $logs->save();

        return back()->with('success', 'New user successfully created.');
    }

    public function editUser($id){
        $user = User::where('id', $id)->first();
        return view('admin.editUser')->with('user', $user);
    }

    public function editUserAccount(Request $request, $id){
        $user = User::where('id', $id)->first();
        $user->name = strip_tags($request['name']);
        $user->last_name = strip_tags($request['last_name']);
        $user->email = strip_tags($request['email']);
        $user->phone_number = strip_tags($request['phone_number']);
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
        $name = strip_tags($request['name']);
        $logs = new Log;
        $logs->user_id = Auth::user()->id;
        $logs->type = 'admin';
        $logs->description = "edited user account";
        $logs->ip_address = \Request::ip();
        $logs->action = 'update';
        $logs->created_at = Carbon::now();
        $logs->save();

        return back()->with('success', 'User updated successfully.');
    }

    public function deleteUser($id){
        $user = User::where('id', $id)->first();
        $wallet = Wallet::where('user_id', $id)->first();
        $name = $user->name;
        if($user->admin){
            return back()->with('error', 'This user of type admin cannot be deleted.');
        }
        $user->delete();
        $wallet->delete();
        $vehicle = Vehicle::where('user_id', $id)->delete();
        $logs = Log::where('user_id', $id)->delete();

        // Post To Logs
        $logs = new Log;
        $logs->user_id = Auth::user()->id;
        $logs->type = 'admin';
        $logs->description = "deleted user | Name: $name";
        $logs->ip_address = \Request::ip();
        $logs->action = 'removed';
        $logs->created_at = Carbon::now();
        $logs->save();

        return back();
    }

    public function reserve(){
        return view('admin.reserve');
    }
    
    public function walkIn(){
        return view('admin.walkin');
    }
}
