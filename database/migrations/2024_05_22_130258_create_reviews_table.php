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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('title');
            $table->string('slug')->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('movie_id')->constrained()->cascadeOnDelete();
            $table->text('content');
            $table->decimal('rating', 3, 1);
            $table->timestamps();
        });

        // Dummy data
        DB::table('reviews')->insert([
            ['title' => 'Great movie!', 'slug' => 'great-movie', 'user_id' => 1, 'movie_id' => 1, 'content' => 'This is a great movie. I love it!', 'rating' => 4.5, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Awesome movie!', 'slug' => 'awesome-movie', 'user_id' => 2, 'movie_id' => 2, 'content' => 'This is an awesome movie. I love it!', 'rating' => 4.7, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Nice movie!', 'slug' => 'nice-movie', 'user_id' => 2, 'movie_id' => 3, 'content' => 'This is a nice movie. I love it!', 'rating' => 4.3, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Good movie!', 'slug' => 'good-movie', 'user_id' => 2, 'movie_id' => 4, 'content' => 'This is a good movie. I love it!', 'rating' => 4.0, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Excellent movie!', 'slug' => 'excellent-movie', 'user_id' => 1, 'movie_id' => 5, 'content' => 'This is an excellent movie. I love it!', 'rating' => 4.2, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
