<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->string('wallet_id',80);
            $table->text('avatar');
            $table->string('name',250);
            $table->string('userid',80);
            $table->text('token');
            $table->unsignedBigInteger('money');
            $table->unsignedInteger('lowest_level');
            $table->unsignedTinyInteger('status')->default(1);
            $table->timestamps();

            $table->primary('wallet_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallets');
    }
}
