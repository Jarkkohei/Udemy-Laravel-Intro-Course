<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //  Changed the default Laravel plural-style name 'author_logs' to singular 'author_log'.
        Schema::create('author_log', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
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
        //  Changed the default Laravel plural-style name 'author_logs' to singular 'author_log'.
        Schema::dropIfExists('author_log');
    }
}
