<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthorLog extends Model
{
    //  Tell Laravel not to look for the default plural-style name of 'author_logs' but the singular 'author_log'.
    protected $table = 'author_log';
}
