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
        // Drop the view if it exists
        DB::unprepared('DROP VIEW IF EXISTS UserWatchlist');

        // Create the view
        DB::unprepared('
            CREATE VIEW UserWatchlist AS
            SELECT
                u.id AS user_id,
                u.name AS user_name,
                u.email AS user_email,
                w.id AS watchlist_id,
                w.movie_id,
                m.title,
                m.slug,
                m.poster_url,
                m.rating,
                m.release_date,
                GROUP_CONCAT(g.name) AS genres
            FROM users u
            JOIN watchlists w ON u.id = w.user_id
            JOIN movies m ON w.movie_id = m.id
            JOIN genre_movie gm ON m.id = gm.movie_id
            JOIN genres g ON gm.genre_id = g.id
            GROUP BY u.id, w.movie_id, w.id, m.title, m.slug, m.poster_url, m.rating, m.release_date;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP VIEW IF EXISTS UserWatchlist');
    }
};
