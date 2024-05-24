<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            // slug is a URL-friendly version of the title
            $table->string('slug')->unique();
            // release_date, director, plot_summary, rating, poster_url,trailer_url, and genres (from genres table, many to many)
            $table->date('release_date');
            $table->string('type'); // movie or series or kseries
            $table->string('director');
            $table->text('plot_summary');
            $table->decimal('rating', 3, 1);
            $table->string('poster_url');
            $table->string('trailer_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
