<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Creates the application's tables on an empty database. On a database restored from
     * a dump the tables already exist, and this does nothing.
     */
    public function up(): void
    {
        if (! Schema::hasTable('schools')) {
            DB::unprepared(file_get_contents(database_path('schema/application.sql')));
        }
    }

    /**
     * The tables hold the school's records, so a rollback leaves them alone.
     */
    public function down(): void
    {
    }
};
