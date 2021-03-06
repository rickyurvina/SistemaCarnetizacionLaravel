<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institutions', function (Blueprint $table) {
            $table->id();
            $table->string('INS_NOMBRE')->unique();
            $table->text('INS_DIRECCION');
            $table->string('INS_TELEFONO');
            $table->string('INS_CELULAR');
            $table->string('INS_TIPO');
            $table->text('INS_MISION')->nullable();
            $table->text('INS_VISION')->nullable();
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
        Schema::dropIfExists('institutions');
    }
}
