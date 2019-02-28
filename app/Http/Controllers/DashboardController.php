<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->admin){
            return redirect(route('adminDashboard'));
        }elseif(Auth::user()->staff){
            return redirect(route('staffDashboard'));
        }else{
            return redirect(route('userDashboard'));
        }
    }
}
