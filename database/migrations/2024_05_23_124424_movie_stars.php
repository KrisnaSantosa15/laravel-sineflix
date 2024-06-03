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
        Schema::create('movie_stars', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('movie_id')->constrained()->cascadeOnDelete();
            $table->foreignId('stars_id')->constrained()->cascadeOnDelete();
            $table->unique(['movie_id', 'stars_id']);
            $table->timestamps();
        });

        // Dummy data
        DB::table('movie_stars')->insert([
            ['movie_id' => 1, 'stars_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['movie_id' => 1, 'stars_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['movie_id' => 1, 'stars_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['movie_id' => 2, 'stars_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['movie_id' => 2, 'stars_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['movie_id' => 2, 'stars_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['movie_id' => 3, 'stars_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['movie_id' => 3, 'stars_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['movie_id' => 3, 'stars_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['movie_id' => 4, 'stars_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['movie_id' => 5, 'stars_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['movie_id' => 5, 'stars_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['movie_id' => 5, 'stars_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['movie_id' => 6, 'stars_id' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
