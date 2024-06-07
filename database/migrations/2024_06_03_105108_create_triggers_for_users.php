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
    public function up()
    {
        // Trigger for INSERT
        DB::unprepared('
            CREATE TRIGGER after_users_insert
            AFTER INSERT ON users
            FOR EACH ROW
            BEGIN
                INSERT INTO log_activities (user_id, action, table_affected, description, action_date, created_at, updated_at)
                VALUES (@user_id, "insert", "users", CONCAT("Inserted a new row with ID ", NEW.id), NOW(), NOW(), NOW());
            END
        ');

        // Trigger for UPDATE
        DB::unprepared('
            CREATE TRIGGER after_users_update
            AFTER UPDATE ON users
            FOR EACH ROW
            BEGIN
                INSERT INTO log_activities (user_id, action, table_affected, description, action_date, created_at, updated_at)
                VALUES (@user_id, "update", "users", CONCAT("Updated row with ID ", NEW.id), NOW(), NOW(), NOW());
            END
        ');

        // Trigger for DELETE
        DB::unprepared('
            CREATE TRIGGER after_users_delete
            AFTER DELETE ON users
            FOR EACH ROW
            BEGIN
                INSERT INTO log_activities (user_id, action, table_affected, description, action_date, created_at, updated_at)
                VALUES (@user_id, "delete", "users", CONCAT("Deleted row with ID ", OLD.id), NOW(), NOW(), NOW());
            END
        ');
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS after_users_insert');
        DB::unprepared('DROP TRIGGER IF EXISTS after_users_update');
        DB::unprepared('DROP TRIGGER IF EXISTS after_users_delete');
    }
};
