<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteLog extends Model
{
    //  Tell Laravel not to look for the default plural-style name of 'quote_logs' but the singular 'quote_log'.
    protected $table = 'quote_log';
}
