<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drowers', function (Blueprint $table) {
            $table->bigInteger("id")->autoIncrement()->unsigned();
            $table->string("drowers_name");
            $table->string("drowers_des")->nullable();
            $table->string("action_type")->nullable();
            $table->string("action_id")->nullable();
            $table->string("action_id_container")->nullable();
            $table->string("action_amount")->nullable();
            $table->bigInteger("prensh_id")->unsigned()->nullable();
            $table->foreign("prensh_id")->references('id')->on("prenshes")->cascadeOnDelete();
            $table->string("drowers_total_amount")->nullable();

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
        Schema::dropIfExists('drowers');
    }
}
