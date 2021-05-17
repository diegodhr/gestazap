<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('num_empleado')->unique();
            $table->string('nombre');
            $table->string('apellido');
            $table->integer('dni')->unique();
            $table->date('fecha_nacimiento');
            $table->date('fecha_inicio');
            $table->integer('telefono');
            $table->string('email')->unique();
            $table->integer('categoria_id');
            $table->integer('rol_id');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
