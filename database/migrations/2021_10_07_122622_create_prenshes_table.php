<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrenshesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prenshes', function (Blueprint $table) {
            $table->bigInteger("id")->autoIncrement()->unsigned();
            $table->string("pre_name");
            $table->text("address")->nullable();
            $table->string("pre_phone")->nullable();
            $table->string("pre_authr")->nullable();
            $table->string("pre_authr_phone")->nullable();
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
        Schema::dropIfExists('prenshes');
    }
}
