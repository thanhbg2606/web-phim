<?php

use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('title')->unique();
            $table->longText('description')->nullable();
            $table->string('image')->nullable();;
            $table->foreignIdFor(Category::class);
            $table->foreignIdFor(Genre::class);
            $table->foreignIdFor(Country::class);
            $table->integer('status');
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
        Schema::dropIfExists('movies');
    }
}
