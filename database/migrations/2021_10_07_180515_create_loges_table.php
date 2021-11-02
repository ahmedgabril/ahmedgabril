<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loges', function (Blueprint $table) {
            $table->bigInteger("id")->autoIncrement()->unsigned();
            $table->bigInteger("loges_action_id")->nullable();
            $table->string("loges_action_type")->nullable();
            $table->string("loges_action_by")->nullable();
            $table->string("loges_action_des")->nullable();


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
        Schema::dropIfExists('loges');
    }
}
