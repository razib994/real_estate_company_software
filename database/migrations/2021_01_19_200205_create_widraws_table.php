<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWidrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('widraws', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bank_id');
            $table->string('checkno')->nullable();
            $table->date('date');
            $table->string('branch_name')->nullable();
            $table->string('check_image')->nullable();
            $table->string('widraw_name')->nullable();
            $table->double('amount');
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
        Schema::dropIfExists('widraws');
    }
}
