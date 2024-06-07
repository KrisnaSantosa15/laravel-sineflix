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
        Schema::create('watchlists', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('movie_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

        // Dummy data
        DB::table('watchlists')->insert([
            ['user_id' => 1, 'movie_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'movie_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'movie_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 2, 'movie_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 2, 'movie_id' => 5, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('watchlists');
    }
};
