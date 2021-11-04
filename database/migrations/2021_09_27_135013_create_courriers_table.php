<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourriersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courriers', function (Blueprint $table) {
            $table->timestamps();
            $table->bigIncrements('id');
            $table->string('client', 100);
            $table->date('date');
            $table->string('status', 10);
            $table->string('fileUrl', 300);
            $table->bigInteger('departement_affecte')->unsigned();
            $table->bigInteger('agent_affecte')->unsigned();
            $table->foreign('agent_affecte')->references('id')->on('agents');
            $table->foreign('departement_affecte')->references('id')->on('departements');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courriers');
    }
}
