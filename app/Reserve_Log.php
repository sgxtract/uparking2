<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserve_Log extends Model
{
    public $table = 'reserve_logs';
    
    public function user(){
        return $this->belongsTo('App\User');
    }
}
