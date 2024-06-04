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
        Schema::create('log_activities', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('action');
            $table->string('table_affected');
            $table->text('description');
            $table->timestamp('action_date')->useCurrent();
            $table->timestamps();
        });

        // dummy data
        DB::table('log_activities')->insert([
            [
                'user_id' => 1,
                'action' => 'insert',
                'table_affected' => 'users',
                'description' => 'Inserted a new row with ID 3',
                'action_date' => now(),
            ],
            [
                'user_id' => 1,
                'action' => 'update',
                'table_affected' => 'genres',
                'description' => 'Updated row with ID 1',
                'action_date' => now(),
            ],
            [
                'user_id' => 1,
                'action' => 'delete',
                'table_affected' => 'movies',
                'description' => 'Deleted row with ID 1',
                'action_date' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_activities');
    }
};
