<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',250);
            $table->text('content');
            $table->string('userid',80);
            $table->unsignedBigInteger('total_income');
            $table->unsignedBigInteger('total_paid');
            $table->unsignedBigInteger('remaining_amount');
            $table->unsignedTinyInteger('ischecked')->default(0);
            $table->dateTime('datechecked');
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
        Schema::dropIfExists('reports');
    }
}
