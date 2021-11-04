<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->timestamps();
            $table->bigIncrements('id');
            $table->string('nom', 11)->nullable()->default(NULL);
            $table->string('prenom', 15)->nullable()->default(NULL);
            $table->string('email', 100);
            $table->string('password', 300);
            $table->integer('departement')->nullable()->default(NULL);
            $table->string('role', 10);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agents');
    }
}
