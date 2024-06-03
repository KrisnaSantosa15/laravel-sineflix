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
        Schema::create('genres', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->timestamps();
        });

        // Dummy data
        DB::table('genres')->insert([
            ['name' => 'Action', 'slug' => 'action', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Adventure', 'slug' => 'adventure', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Animation', 'slug' => 'animation', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Biography', 'slug' => 'biography', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Comedy', 'slug' => 'comedy', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Crime', 'slug' => 'crime', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Documentary', 'slug' => 'documentary', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Drama', 'slug' => 'drama', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Family', 'slug' => 'family', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Fantasy', 'slug' => 'fantasy', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'History', 'slug' => 'history', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Horror', 'slug' => 'horror', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mystery', 'slug' => 'mystery', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Romance', 'slug' => 'romance', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sci-Fi', 'slug' => 'sci-fi', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sport', 'slug' => 'sport', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Thriller', 'slug' => 'thriller', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genres');
    }
};
