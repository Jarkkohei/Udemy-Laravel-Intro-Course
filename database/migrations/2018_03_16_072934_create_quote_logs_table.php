<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //  Changed the default Laravel plural-style name 'quote_logs' to singular 'quote_log'.
        Schema::create('quote_log', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            //  Added the string-type column named 'author'.
            $table->string('author');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quote_log');
    }
}
