<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserUpdate;
use App\Http\Requests\AddVehicle;
use Carbon\Carbon;
use Carbon\CarbonInterval;
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

    public function incomeSalesReport(){
        $dt = Carbon::today();
        $logs = Reserve_Log::all();
        $ctr0 = $ctr1 = $ctr2 = $ctr3 = $ctr4 = $ctr5 = $ctr6 = 0;
        // Days
        $sunday = $monday = $tuesday = $wednesday = $thursday = $friday = $saturday = 0;

        if($dt){
            foreach($logs as $log){
                if(Carbon::parse($log->created_at)->dayOfWeek == Carbon::SUNDAY){
                    $ctr0 += 1;
                    $sunday += $log->payment;
                }
                if(Carbon::parse($log->created_at)->dayOfWeek == Carbon::MONDAY){
                    $ctr1 += 1;
                    $monday += $log->payment;
                }
                if(Carbon::parse($log->created_at)->dayOfWeek == Carbon::TUESDAY){
                    $ctr2 += 1;
                    $tuesday += $log->payment;
                }
                if(Carbon::parse($log->created_at)->dayOfWeek == Carbon::WEDNESDAY){
                    $ctr3 += 1;
                    $wednesday += $log->payment;
                }
                if(Carbon::parse($log->created_at)->dayOfWeek == Carbon::THURSDAY){
                    $ctr4 += 1;
                    $thursday += $log->payment;
                }
                if(Carbon::parse($log->created_at)->dayOfWeek == Carbon::FRIDAY){
                    $ctr5 += 1;
                    $friday += $log->payment;
                }
                if(Carbon::parse($log->created_at)->dayOfWeek == Carbon::SATURDAY){
                    $ctr6 += 1;
                    $saturday += $log->payment;
                }
            }
        }

        $data = [
            'sunday' => $sunday,
            'monday' => $monday,
            'tuesday' => $tuesday,
            'wednesday' => $wednesday,
            'thursday' => $thursday,
            'friday' => $friday,
            'saturday' => $saturday,
        ];

        $dataCtr = [
            'sun' => $ctr0,
            'mon' => $ctr1,
            'tue' => $ctr2,
            'wed' => $ctr3,
            'thu' => $ctr4,
            'fri' => $ctr5,
            'sat' => $ctr6,
        ];

        return view('admin.income_sales_report')->with(['data' => $data, 'dataCtr' => $dataCtr]);

    }

    public function salesReport(){

        $dt = Carbon::today();
        $logs = Reserve_Log::all();
        // Days
        $sunday = $monday = $tuesday = $wednesday = $thursday = $friday = $saturday = 0;

        if($dt){
            foreach($logs as $log){
                if(Carbon::parse($log->created_at)->dayOfWeek == Carbon::SUNDAY){
                    $sunday += $log->payment;
                }
                if(Carbon::parse($log->created_at)->dayOfWeek == Carbon::MONDAY){
                    $monday += $log->payment;
                }
                if(Carbon::parse($log->created_at)->dayOfWeek == Carbon::TUESDAY){
                    $tuesday += $log->payment;
                }
                if(Carbon::parse($log->created_at)->dayOfWeek == Carbon::WEDNESDAY){
                    $wednesday += $log->payment;
                }
                if(Carbon::parse($log->created_at)->dayOfWeek == Carbon::THURSDAY){
                    $thursday += $log->payment;
                }
                if(Carbon::parse($log->created_at)->dayOfWeek == Carbon::FRIDAY){
                    $friday += $log->payment;
                }
                if(Carbon::parse($log->created_at)->dayOfWeek == Carbon::SATURDAY){
                    $saturday += $log->payment;
                }
            }
        }

        // Weeks
        $weeklyStart = Carbon::now()->startOfWeek();
        $weekly = 0;

        $weeklyLogs = Reserve_Log::whereBetween('created_at', [$weeklyStart, $weeklyStart->copy()->addDays(6)])->get();

        foreach($weeklyLogs as $weeklyLog){
            $weekly += $weeklyLog->payment;
        }

        $data = [
            'sunday' => $sunday,
            'monday' => $monday,
            'tuesday' => $tuesday,
            'wednesday' => $wednesday,
            'thursday' => $thursday,
            'friday' => $friday,
            'saturday' => $saturday,
            'weekly' => $weekly,
        ];

        // Months
        $monthStart = Carbon::now()->month;
        $monthlyLogs = Reserve_Log::all();

        $january = $february = $march = $april = $may = $june = $july = $august = $september = $october = $november = $december = 0;

        foreach($monthlyLogs as $monthlyLog){
            if(Carbon::parse($monthlyLog->created_at)->month == 1){
                $january += $monthlyLog->payment;
            }
            if(Carbon::parse($monthlyLog->created_at)->month == 2){
                $february += $monthlyLog->payment;
            }
            if(Carbon::parse($monthlyLog->created_at)->month == 3){
                $march += $monthlyLog->payment;
            }
            if(Carbon::parse($monthlyLog->created_at)->month == 4){
                $april += $monthlyLog->payment;
            }
            if(Carbon::parse($monthlyLog->created_at)->month == 5){
                $may += $monthlyLog->payment;
            }
            if(Carbon::parse($monthlyLog->created_at)->month == 6){
                $june += $monthlyLog->payment;
            }
            if(Carbon::parse($monthlyLog->created_at)->month == 7){
                $july += $monthlyLog->payment;
            }
            if(Carbon::parse($monthlyLog->created_at)->month == 8){
                $august += $monthlyLog->payment;
            }
            if(Carbon::parse($monthlyLog->created_at)->month == 9){
                $september += $monthlyLog->payment;
            }
            if(Carbon::parse($monthlyLog->created_at)->month == 10){
                $october += $monthlyLog->payment;
            }
            if(Carbon::parse($monthlyLog->created_at)->month == 11){
                $november += $monthlyLog->payment;
            }
            if(Carbon::parse($monthlyLog->created_at)->month == 12){
                $december += $monthlyLog->payment;
            }
        }

        $data2 = [
            'jan' => $january,
            'feb' => $february,
            'mar' => $march,
            'apr' => $april,
            'may' => $may,
            'jun' => $june,
            'jul' => $july,
            'aug' => $august,
            'sep' => $september,
            'oct' => $october,
            'nov' => $november,
            'dec' => $december,
        ];

        return view('admin.sales_report')->with(['data' => $data, 'data2' => $data2]);
    }

    public function statisticsReport(){
        $stats = Reserve_Log::all();
        $totalRevenue = 0;
        $totalTransactions = count($stats);

        foreach($stats as $stat){
            $totalRevenue += $stat->payment;
        }

        $averageTicketValue = $totalRevenue / $totalTransactions;
        $averageLengthOfStay = 0;

        if($averageTicketValue > 0 && round($averageTicketValue) < 50 ){
            $averageLengthOfStay = 2; // Hours
        }else if($averageTicketValue > 50 && round($averageTicketValue) < 75 ){
            $averageLengthOfStay = 3; // Hours
        }else if($averageTicketValue > 75 && round($averageTicketValue) < 100 ){
            $averageLengthOfStay = 4; // Hours
        }else if($averageTicketValue > 100 && round($averageTicketValue) < 125 ){
            $averageLengthOfStay = 5; // Hours
        }else if($averageTicketValue > 125 && round($averageTicketValue) < 150 ){
            $averageLengthOfStay = 6; // Hours
        }else if($averageTicketValue > 150 && round($averageTicketValue) < 175 ){
            $averageLengthOfStay = 7; // Hours
        }else if($averageTicketValue > 175 && round($averageTicketValue) < 200 ){
            $averageLengthOfStay = 8; // Hours
        }else if($averageTicketValue > 200 && round($averageTicketValue) < 225 ){
            $averageLengthOfStay = 9; // Hours
        }else if($averageTicketValue > 225 && round($averageTicketValue) < 250 ){
            $averageLengthOfStay = 10; // Hours
        }else if($averageTicketValue > 250 && round($averageTicketValue) < 275 ){
            $averageLengthOfStay = 11; // Hours
        }else if($averageTicketValue > 275 && round($averageTicketValue) < 300 ){
            $averageLengthOfStay = 12; // Hours
        }else{
            $averageLengthOfStay = 13; // Hours
        }

        // Frequency of Use
        $frequency = $totalTransactions / 62;

        $data = [
            'avt' => round($averageTicketValue),
            'als' => $averageLengthOfStay,
            'frq' => $frequency,
        ];

        return view('admin.statistics_report')->with('data', $data);
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
        $logs = Log::where('type', 'user')->get();
        return view('admin.logs.user-logs')->with('logs', $logs);
    }

    public function staffLogs(){
        $logs = Log::where(['type' => 'staff', 'type' => 'admin'])->get();
        return view('admin.logs.staff-logs')->with('logs', $logs);
    }

    public function parkingLogs(){
        $logs = Reserve_Log::all();
        return view('admin.logs.parking-logs')->with('logs', $logs);
    }
    // End History Logs

    public function users(){
        $users = User::where('admin', false)->get();
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

    public function activateUser($id){
        $user = User::where('id', $id)->first();
        $name = $user->name;
        $user->status = true;
        $user->save();

        $logs = new Log;
        $logs->user_id = Auth::user()->id;
        $logs->type = 'admin';
        $logs->description = "activated user | Name: $name";
        $logs->ip_address = \Request::ip();
        $logs->action = 'activate';
        $logs->created_at = Carbon::now();
        $logs->save();

        return back()->with('success', 'Activated user <strong>' .  $name . ' ' . $user->last_name . '</strong>');
    }

    public function deleteUser($id){
        $user = User::where('id', $id)->first();
        $name = $user->name;
        if($user->admin){
            return back()->with('error', 'This user of type admin cannot be deleted.');
        }
        $user->status = false;
        $user->save();

        // $user->delete();
        // $wallet->delete();
        // $vehicle = Vehicle::where('user_id', $id)->delete();
        // $logs = Log::where('user_id', $id)->delete();

        // Post To Logs
        $logs = new Log;
        $logs->user_id = Auth::user()->id;
        $logs->type = 'admin';
        $logs->description = "deactivated user | Name: $name";
        $logs->ip_address = \Request::ip();
        $logs->action = 'deactivate';
        $logs->created_at = Carbon::now();
        $logs->save();

        return back()->with('error', 'Deactivated user <strong>' .  $name . ' ' . $user->last_name . '</strong>');
    }

    public function reserve(){
        return view('admin.reserve');
    }
    
    public function walkIn(){
        return view('admin.walkin');
    }
}
