<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->integer('PER_CEDULA')->unique();
            $table->string('PER_NOMBRES');
            $table->string('PER_APELLIDOS');
            $table->char('PER_SEXO',10);
            $table->dateTime('PER_FECHANACIMIENTO');
            $table->char('PER_TIPOSANGRE',20);
            $table->string('PER_CORREO')->unique();
            $table->string('PER_DIRECCION')->nullable();
            $table->string('PER_NUMERO')->nullable();
            $table->string('PER_CELULAR')->nullable();
            $table->foreignId('institution_id')->constrained();
            $table->foreignId('area_id')->constrained();
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
        Schema::dropIfExists('people');
    }
}
