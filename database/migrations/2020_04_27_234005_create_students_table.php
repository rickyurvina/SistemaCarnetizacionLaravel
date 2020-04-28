<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->integer('EST_CEDULA');
            $table->string('EST_NOMBRES');
            $table->string('EST_APELLIDOS');
            $table->char('EST_SEXO',10);
            $table->timestamp('EST_FECHANAC
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            IMIENTO');
            $table->char('EST_TIPOSANGRE',10);
            $table->string('EST_CORREO');
            $table->string('EST_DIRECCION')->nullable();
            $table->string('EST_NUMERO')->nullable();
            $table->string('EST_CELULAR')->nullable();
            $table->string('EST_CODIGO')->nullable();
            $table->string('EST_MATRICULA')->nullable();
            $table->string('EST_INSCRITO')->nullable();
            $table->string('EST_NROMATRICULA')->nullable();
            $table->string('EST_RETIRADO')->nullable();
            $table->string('EST_BECA')->nullable();
            $table->foreignId('course_id')->constrained();
            $table->foreignId('institution_id')->constrained();
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
        Schema::dropIfExists('students');
    }
}
