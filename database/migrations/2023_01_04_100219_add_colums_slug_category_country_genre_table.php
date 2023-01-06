<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumsSlugCategoryCountryGenreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });

        Schema::table('countries', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });

        Schema::table('genres', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('genres', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
