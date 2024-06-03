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
        // Drop the function if it exists
        DB::unprepared('DROP FUNCTION IF EXISTS GetAverageRating');

        // Create the function
        DB::unprepared('
        CREATE FUNCTION GetAverageRating(movieId INT) RETURNS DECIMAL(3, 1)
        DETERMINISTIC
        BEGIN
            DECLARE avgRating DECIMAL(3, 1);
            SELECT AVG(rating) INTO avgRating FROM reviews WHERE movie_id = movieId;
            RETURN avgRating;
        END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP FUNCTION IF EXISTS GetAverageRating');
    }
};
