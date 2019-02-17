<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Wallet;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function checkoutOrder(Request $request, $id){

    }

    // public function confirmOrder($amount){
    //     $wallet = Wallet::where('user_id', Auth::user()->id)->first();
    //     $wallet->balance += Crypt::decrypt($amount);
    //     $wallet->updated_at = Carbon::now();
    //     $wallet->save();
    //     return redirect()->route('userBalance');
    // }
}
