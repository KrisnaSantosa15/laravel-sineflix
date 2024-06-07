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
        Schema::create('movies', function (Blueprint $table) {
            $table->id()->autoIncrement();
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
            $table->string('poster_banner');
            $table->string('trailer_url');
            $table->timestamps();
        });

        // Dummy data
        DB::table('movies')->insert([
            ['title' => 'Inception', 'slug' => 'inception', 'release_date' => '2010-07-16', 'type' => 'MOVIE', 'director' => 'Christopher Nolan', 'plot_summary' => 'A thief who steals corporate secrets through the use of dream-sharing technology.', 'rating' => 4.5, 'poster_banner' => 'https://image.tmdb.org/t/p/original/ncEsesgOJDNrTUED89hYbA117wo.jpg' ,'poster_url' => 'https://www.movieposters.com/cdn/shop/files/inception.mpw.123395_9e0000d1-bc7f-400a-b488-15fa9e60a10c_480x.progressive.jpg?v=1708527589', 'trailer_url' => 'https://www.youtube.com/watch?v=YoHD9XEInc0/', 'created_at' => now(), 'updated_at' => now()],

            ['title' => 'The Matrix', 'slug' => 'the-matrix', 'release_date' => '1999-03-31', 'type' => 'SERIES', 'director' => 'Lana Wachowski, Lilly Wachowski', 'plot_summary' => 'A computer hacker learns about the true nature of his reality and his role in the war against its controllers.', 'rating' => 4.7, 'poster_banner' => 'https://image.tmdb.org/t/p/original/ncEsesgOJDNrTUED89hYbA117wo.jpg', 'poster_url' => 'https://www.movieposters.com/cdn/shop/files/Matrix.mpw.102176_bb2f6cc5-4a16-4512-881b-f855ead3c8ec_480x.progressive.jpg?v=1708703624', 'trailer_url' => 'https://www.youtube.com/watch?v=vKQi3bBA1y8', 'created_at' => now(), 'updated_at' => now()],

            ['title' => 'The Shawshank Redemption', 'slug' => 'the-shawshank-redemption', 'release_date' => '1994-10-14', 'type' => 'SERIES', 'director' => 'Frank Darabont', 'plot_summary' => 'Two imprisoned after a wrongful accusation, escape prison and become friends.', 'rating' => 4.3, 'poster_banner' => 'https://image.tmdb.org/t/p/original/ncEsesgOJDNrTUED89hYbA117wo.jpg', 'poster_url' => 'https://www.movieposters.com/cdn/shop/files/shawshank_eb84716b-efa9-44dc-a19d-c17924a3f7df_480x.progressive.jpg?v=1709821984', 'trailer_url' => 'https://www.youtube.com/watch?v=6hB3S9bIaco', 'created_at' => now(), 'updated_at' => now()],

            ['title' => 'The Dark Knight', 'slug' => 'the-dark-knight', 'release_date' => '2008-07-18', 'type' => 'K-SERIES', 'director' => 'Christopher Nolan', 'plot_summary' => 'When the menace known as the Joker wreaks havoc and chaos on the people of Gotham, Batman must accept one of the greatest psychological and physical tests of his ability to fight injustice.', 'rating' => 4.0, 'poster_banner' => 'https://image.tmdb.org/t/p/original/ncEsesgOJDNrTUED89hYbA117wo.jpg', 'poster_url' => 'https://www.movieposters.com/cdn/shop/files/darkknight.building.24x36_20e90057-f673-4cc3-9ce7-7b0d3eeb7d83_480x.progressive.jpg?v=1707491191', 'trailer_url' => 'https://www.youtube.com/watch?v=EXeTwQWrcwY', 'created_at' => now(), 'updated_at' => now()],

            ['title' => 'The Godfather', 'slug' => 'the-godfather', 'release_date' => '1972-03-24', 'type' => 'MOVIE', 'director' => 'Francis Ford Coppola', 'plot_summary' => 'The aging patriarch of an organized crime dynasty transfers control of his clandestine empire to his reluctant son.', 'rating' => 4.2, 'poster_banner' => 'https://image.tmdb.org/t/p/original/ncEsesgOJDNrTUED89hYbA117wo.jpg', 'poster_url' => 'https://www.movieposters.com/cdn/shop/products/b5282f72126e4919911509e034a61f66_6ce2486d-e0da-4b7a-9148-722cdde610b8_480x.progressive.jpg?v=1573616025', 'trailer_url' => 'https://www.youtube.com/watch?v=UaVTIH8mujA', 'created_at' => now(), 'updated_at' => now()],

            ['title' => 'The Lord of the Rings: The Return of the King', 'slug' => 'the-lord-of-the-rings-the-return-of-the-king', 'release_date' => '2003-12-17', 'type' => 'MOVIE', 'director' => 'Peter Jackson', 'plot_summary' => 'Gandalf and Aragorn lead the World Big Screen to the Black Gate to distract Sauron and buy Frodo time to destroy the Ring.', 'rating' => 4.6, 'poster_banner' => 'https://image.tmdb.org/t/p/original/ncEsesgOJDNrTUED89hYbA117wo.jpg', 'poster_url' => 'https://www.movieposters.com/cdn/shop/products/d91a07f221afcf4022140927554e7070_3998f8ee-d593-4af4-af37-eb63ca17e83f_480x.progressive.jpg?v=1635431710', 'trailer_url' => 'https://www.youtube.com/watch?v=V75dMMIW2B4', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
