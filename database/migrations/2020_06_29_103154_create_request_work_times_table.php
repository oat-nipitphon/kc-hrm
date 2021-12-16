<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestWorkTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_work_times', function (Blueprint $table) {
            $table->bigIncrements('id');            
            $table->integer('request_id');
            $table->integer('request_type');
            $table->string('remark');
            $table->integer('user_id');
            $table->integer('approve_by');
            $table->string('employee_id');
            $table->date('start_time');
            $table->date('end_time');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_work_times');
    }
}
