<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->bigInteger("id")->autoIncrement()->unsigned();
            $table->bigInteger('genries_id')->unsigned()->nullable();
            $table->foreign('genries_id')->references('id')->on('genries')->cascadeOnDelete();
            $table->bigInteger('customers_id')->unsigned()->nullable();
            $table->foreign('customers_id')->references('id')->on('customers')->cascadeOnDelete();
            $table->bigInteger('prensh_id')->unsigned()->nullable();
            $table->foreign('prensh_id')->references('id')->on('prenshes')->cascadeOnDelete();
            $table->bigInteger('store_id')->unsigned()->nullable();
            $table->foreign('store_id')->references('id')->on('stores')->cascadeOnDelete();
            $table->bigInteger('drower_id')->unsigned()->nullable();
            $table->foreign('drower_id')->references('id')->on('drowers')->cascadeOnDelete();
            $table->string("ship_consignee_name");
            $table->string("ship_consignee_adress");
            $table->string("ship_consignee_phone1");
            $table->string("ship_consignee_phone2")->nullable();
            $table->text("ship_des")->nullable();
            $table->string("ship_code_number")->nullable();
            $table->datetime("ship_date");
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
        Schema::dropIfExists('shipments');
    }
}
