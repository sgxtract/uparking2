<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'email', 'phone_number', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = [
        'current_sign_in_at', 
        'last_sign_in_at',
    ];

    public function logs(){
        return $this->hasMany('App\Log');
    }

    public function vehicles(){
        return $this->hasMany('App\Vehicle');
    }

    public function wallets(){
        return $this->hasMany('App\Wallet');
    }

    public function reserves(){
        return $this->hasMany('App\Reserve');
    }

    public function reserveLogs(){
        return $this->hasMany('App\Reserve_Log');
    }
}
