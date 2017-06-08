<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    public function bill()
    {
        return $this->belongsTo('App\Bill');
    }

    public function tag()
    {
        return $this->hasOne('App\Tag');
    }
}
