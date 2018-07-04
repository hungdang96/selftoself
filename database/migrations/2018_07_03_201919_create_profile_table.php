<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->string('id',80);
            $table->text('avatar');
            $table->string('fullname');
            $table->date('dob');
            $table->string('sexual',10);
            $table->string('userid',80);
            $table->string('IDcard',20);
            $table->string('phone',20)->unique();
            $table->string('address',250);
            $table->unsignedInteger('provinceid');
            $table->unsignedInteger('districtid');
            $table->unsignedInteger('wardid');
            $table->timestamps();

            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile');
    }
}
