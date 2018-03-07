<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NiceActionLog extends Model
{
    public function nice_action() 
    {
        // "One to many"-relation.
        return $this->belongsTo('App\NiceAction');
    }
}
