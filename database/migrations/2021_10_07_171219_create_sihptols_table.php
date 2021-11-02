<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSihptolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sihptols', function (Blueprint $table) {
            $table->bigInteger("id")->autoIncrement()->unsigned();
            $table->string("sihptols_type");
            $table->string("sihptols_count");
            $table->string("sihptols_prodect_name");
            $table->text("sihptols_des")->nullable();
            $table->string("sihptols_total_price");
            $table->bigInteger("shipments_id")->unsigned()->nullable();
            $table->foreign("shipments_id")->references("id")->on("shipments")->onDelete("cascade");
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
        Schema::dropIfExists('sihptols');
    }
}
