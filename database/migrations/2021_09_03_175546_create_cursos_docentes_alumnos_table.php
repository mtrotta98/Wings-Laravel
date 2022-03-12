<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursosDocentesAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos_docentes_alumnos', function (Blueprint $table) {
            $table->id();
            $table->integer('id_docente');
            $table->integer('id_libro');
            $table->integer('id_alumno');
            $table->integer('id_curso');
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
        Schema::dropIfExists('cursos_docentes_alumnos');
    }
}
