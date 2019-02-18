<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tmdb_id');
            $table->string('imdb_id')->nullable();
            $table->string('title');
            $table->string('status');
            $table->unsignedInteger('runtime')->nullable();
            $table->text('overview');
            $table->string('poster')->nullable();
            $table->date('release_date');
            $table->timestamps();

            $table->unique('tmdb_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
