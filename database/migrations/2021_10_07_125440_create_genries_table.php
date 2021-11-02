<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genries', function (Blueprint $table) {
            $table->bigInteger("id")->autoIncrement()->unsigned();
            $table->string("gen_number");
            $table->mediumText("gen_des")->nullable();
            $table->date("gen_date_start");
            $table->date("gen_date_end")->nullable();
            $table->tinyInteger("gen_status")->default(0);
            $table->bigInteger("prensh_id")->unsigned()->nullable();
            $table->foreign("prensh_id")->references('id')->on("prenshes")->cascadeOnDelete();
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
        Schema::dropIfExists('genries');
    }
}
