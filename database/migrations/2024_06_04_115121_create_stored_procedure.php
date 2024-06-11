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

        DB::unprepared('DROP PROCEDURE IF EXISTS GenerateMovieRecommendations');

        DB::unprepared('

CREATE PROCEDURE IF NOT EXISTS GenerateMovieRecommendations(
    IN userId INT,
    IN numRecommendations INT
)
BEGIN
    CREATE TEMPORARY TABLE IF NOT EXISTS PreferredGenres (
        genre_id INT
    );

    INSERT INTO PreferredGenres (genre_id)
    SELECT gm.genre_id
    FROM watchlists w
    JOIN movies m ON w.movie_id = m.id
    JOIN genre_movie gm ON m.id = gm.movie_id
    WHERE w.user_id = userId
    GROUP BY gm.genre_id
    ORDER BY COUNT(*) DESC
    LIMIT 3;

    SELECT DISTINCT m.id, m.slug, m.title, m.release_date, m.director, m.plot_summary, m.rating, m.poster_url, m.trailer_url,
    GROUP_CONCAT(DISTINCT g.name ORDER BY g.name SEPARATOR ", ") AS genres
    FROM movies m
    JOIN genre_movie gm ON m.id = gm.movie_id
    JOIN genres g ON gm.genre_id = g.id
    WHERE gm.genre_id IN (SELECT genre_id FROM PreferredGenres)
    AND m.id NOT IN (SELECT movie_id FROM watchlists WHERE user_id = userId)
    AND m.id NOT IN (
        SELECT r.movie_id
        FROM reviews r
        WHERE r.user_id = userId
        AND r.rating < 3
    )
    GROUP BY m.id, m.slug, m.title, m.release_date, m.director, m.plot_summary, m.rating, m.poster_url, m.trailer_url
    LIMIT numRecommendations;

    DROP TEMPORARY TABLE IF EXISTS PreferredGenres;
END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS GenerateMovieRecommendations');
    }
};
