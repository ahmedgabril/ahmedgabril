<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->biginteger("id")->autoIncrement()->unsigned();
            $table->string("expenses_name");
            $table->string("expenses_type")->nullable();
            $table->string("expenses_price")->nullable();
            $table->string("expenses_des")->nullable();
            $table->string("expenses_deployer")->nullable();
            $table->bigInteger("genries_id")->unsigned()->nullable();
            $table->foreign("genries_id")->references("id")->on("genries")->cascadeOnDelete();
            $table->bigInteger("drowers_id")->unsigned()->nullable();
            $table->foreign("drowers_id")->references("id")->on("drowers")->cascadeOnDelete();
            $table->bigInteger("prenshes_id")->unsigned()->nullable();
            $table->foreign("prenshes_id")->references("id")->on("prenshes")->cascadeOnDelete();
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
        Schema::dropIfExists('expenses');
    }
}
