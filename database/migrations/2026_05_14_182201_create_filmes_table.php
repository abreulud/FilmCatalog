<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Filmes extends Migration
{

    public function up()
    {
        Schema::create('filmes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo', 200);
            $table->text('sinopse', 200)->nullable();
            $table->string('diretor', 150)->nullable();
            $table->integer('ano_lancamento');
            $table->integer('duracao')->nullable();
            $table->string('classificacao', 50)->nullable();
            $table->decimal('nota', 3, 1)->nullable();

            $table->integer('categoria_id')->unsigned();
            $table->foreign('categoria_id')
                  ->references('id')
                  ->on('categorias')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('filmes');
    }
}
