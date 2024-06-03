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
        Schema::create('stars', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name');
            $table->string('slug')->unique();
            $table->date('birth_date')->nullable();
            $table->string('birth_place')->nullable();
            $table->text('biography')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });



        // Dummy data
        DB::table('stars')->insert([
            ['name' => 'Leonardo DiCaprio', 'slug' => 'leonardo-dicaprio', 'birth_date' => '1974-11-11', 'birth_place' => 'Los Angeles, California, USA', 'biography' => 'Leonardo Wilhelm DiCaprio is an American actor, producer, and environmentalist. He has often played unconventional roles, particularly in biopics and period films. As of 2019, his films have grossed US$7.2 billion worldwide, and he has placed eight times in annual rankings of the world\'s highest-paid actors. His accolades include an Academy Award, a BAFTA, and a Golden Globe Award for The Revenant (2015), and two Golden Globe Awards for The Aviator (2004). Born in Los Angeles, DiCaprio began his career by appearing in television commercials in the late 1980s. In the early 1990s, he played recurring roles in various television series, such as the sitcom Parenthood. He had his first major film role in This Boy\'s Life (1993) and received acclaim for the supporting role of a developmentally', 'image' => null, 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Tom Hanks', 'slug' => 'tom-hanks', 'birth_date' => '1956-07-09', 'birth_place' => 'Concord, California, USA', 'biography' => 'Thomas Jeffrey Hanks is an American actor and filmmaker. Known for both his comedic and dramatic roles, Hanks is one of the most popular and recognizable film stars worldwide, and is regarded as an American cultural icon. Hanks\' films have grossed more than $4.9 billion in North America and more than $9.96 billion worldwide, making him the fourth-highest-grossing actor in North America. Hanks made his breakthrough with leading roles in the comedies Splash (1984) and Big (1988). He won two consecutive Academy Awards for Best Actor for starring as', 'image' => null, 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Robert Downey Jr.', 'slug' => 'robert-downey-jr', 'birth_date' => '1965-04-04', 'birth_place' => 'Manhattan, New York, USA', 'biography' => 'Robert John Downey Jr. is an American actor and producer. His career has been characterized by critical and popular success in his youth, followed by a period of substance abuse and legal difficulties, before a resurgence of commercial success in middle age. In 2008, Downey was named by Time magazine among the 100 most influential people in the world, and from 2013 to 2015, he was listed by Forbes as Hollywood\'s highest-paid actor. His films have grossed over $14.4 billion worldwide, making him the second highest-grossing box-office star of all time. At the age of five, he made his acting debut in Robert Downey Sr.\'s film Pound in 1970. He subsequently worked with the Brat Pack in the teen films Weird Science (1985) and Less Than Zero (1987). In 1992, Downey portrayed the title character in the biopic Chaplin, for which he was nominated for the Academy Award for Best Actor and won a BAFTA Award. Following a stint at the Corcoran Substance Abuse Treatment Facility on drug charges, he joined the television series Ally McBeal, for which he won a Golden Globe Award; however, Downey\'s', 'image' => null, 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Morgan Freeman', 'slug' => 'morgan-freeman', 'birth_date' => '1937-06-01', 'birth_place' => 'Memphis, Tennessee, USA', 'biography' => 'Morgan Freeman is an American actor, director, and narrator. Noted for his distinctive deep voice, Freeman has appeared in a range of film genres portraying character roles and is particularly known for his distinctive voice. Freeman is the recipient of various accolades, including an Academy Award, a Golden Globe Award, and a Screen Actors Guild Award. Born in Memphis, Tennessee, Freeman was raised in Mississippi where he began acting in school plays. He studied theatre arts in Los Angeles and appeared in stage productions in his early career. He rose to fame in the 1970s for his role in the children\'s television series', 'image' => null, 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Denzel Washington', 'slug' => 'denzel-washington', 'birth_date' => '1954-12-28', 'birth_place' => 'Mount Vernon, New York, USA', 'biography' => 'Denzel Hayes Washington Jr. is an American actor, director, and producer. Known for his performances on the screen and stage, he has been described as an actor who reconfigured "the concept of classic movie stardom". He has received various accolades throughout his career and is regarded as one of the greatest actors of his generation. Washington has received seventeen NAACP Image Awards, three Golden Globe Awards, one Tony Award, and two Academy Awards: Best Supporting Actor for playing Union Army soldier Private Trip in the historical drama film Glory (1989), and Best Actor for his role as corrupt detective Alonzo Harris in the crime thriller Training Day (2001). In 2020, The New York Times ranked him as the greatest actor of the 21st century. Washington has also been awarded the Cecil B. DeMille Lifetime Achievement Award. In 2016, he received the Golden Globe Cecil B. DeMille Award for "outstanding contributions to the world of entertainment".', 'image' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stars');
    }
};
