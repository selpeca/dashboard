<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('primer_nombre',45);
            $table->string('segundo_nombre',45)->nullable();
            $table->string('primer_apellido',45);
            $table->string('segundo_apellido',45)->nullable();
            $table->enum('tip_id',['CC','TI','TP','RC','CE','CI']);
            $table->string('num_id',45);
            $table->string('tel',15)->nullable();
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
        Schema::dropIfExists('clients');
    }
}
