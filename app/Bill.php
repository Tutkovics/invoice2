<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use SoftDeletes;


    public function user(){
        return $this->belongsTo('App\User');
    }

    public function transactions(){
        return $this->hasMany('App\Transaction');
    }

}
