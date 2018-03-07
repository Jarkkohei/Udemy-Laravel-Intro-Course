<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NiceAction extends Model
{
    public function logged_actions()
    {
        return $this->hasMany('App\NiceActionLog');
    }
}
