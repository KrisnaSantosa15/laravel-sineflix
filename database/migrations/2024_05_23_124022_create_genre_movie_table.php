<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('genre_movie', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('movie_id')->constrained()->cascadeOnDelete();
            $table->foreignId('genre_id')->constrained()->cascadeOnDelete();
            $table->unique(['movie_id', 'genre_id']);
            $table->timestamps();
        });


        // Dummy data
        DB::table('genre_movie')->insert([
            ['movie_id' => 1, 'genre_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['movie_id' => 1, 'genre_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['movie_id' => 1, 'genre_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['movie_id' => 2, 'genre_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['movie_id' => 2, 'genre_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['movie_id' => 2, 'genre_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['movie_id' => 3, 'genre_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['movie_id' => 3, 'genre_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['movie_id' => 3, 'genre_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['movie_id' => 3, 'genre_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['movie_id' => 4, 'genre_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['movie_id' => 5, 'genre_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['movie_id' => 5, 'genre_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['movie_id' => 5, 'genre_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['movie_id' => 6, 'genre_id' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genre_movie');
    }
};
