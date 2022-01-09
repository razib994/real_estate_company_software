<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeadOfficeOverheadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('head_office_overheads', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('particular_id');
            $table->foreignId('bank_id');
            $table->date('date');
            $table->date('start_date');
            $table->date('end_date');
            $table->double('amount');
            $table->string('payment_method')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('head_office_overheads');
    }
}
