<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departements', function (Blueprint $table) {
            $table->timestamps();
            $table->bigInteger('id')->unsigned();
            $table->string('departement', 200);
            $table->string('sigle', 5)->nullable();
            $table->bigInteger('chef_id')->unsigned();
            $table->bigInteger('parent')->unsigned();
            $table->primary('id');
            $table->foreign('chef_id')->references('id')->on('agents');
            $table->foreign('parent')->references('id')->on('departements');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departements');
    }
}
