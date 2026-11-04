<?php

namespace Tests;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * The tables the tested pages use, on sqlite. database/schema/application.sql is written
 * for MySQL, so it cannot be loaded here.
 */
trait CreatesApplicationSchema
{
    protected function createApplicationSchema(): void
    {
        $this->table('global_setting', ['brand_title', 'brand_name', 'language', 'theme_name', 'time_zone', 'date_format', 'brand_logo', 'favicon_icon', 'brand_footer', 'currency', 'currency_symbol', 'enable_frontend', 'enable_rtl', 'default_school_id', 'status']);
        $this->table('schools', ['branch_name', 'branch_url', 'email', 'theme_name', 'language', 'enable_frontend', 'status', 'logo', 'footer']);
        $this->table('academic_years', ['session_year', 'start_year', 'end_year', 'note', 'is_running', 'status']);
        $this->table('roles', ['slug', 'name', 'note', 'is_default', 'is_super_admin', 'status', 'created_by', 'modified_by']);
        $this->table('modules', ['module_name', 'module_slug', 'status']);
        $this->table('operations', ['module_id', 'operation_name', 'operation_slug', 'is_view_vissible', 'is_add_vissible', 'is_edit_vissible', 'is_delete_vissible', 'status']);
        $this->table('privileges', ['role_id', 'operation_id', 'is_add', 'is_edit', 'is_view', 'is_delete', 'status']);
        $this->table('users', ['role_id', 'branch_id', 'username', 'password', 'temp_password', 'reset_key', 'status', 'last_logged_in', 'created_by', 'modified_by']);
        $this->table('system_admin', ['user_id', 'name', 'email', 'phone', 'photo', 'status']);
        $this->table('employees', ['user_id', 'name', 'email', 'phone', 'photo', 'status']);
        $this->table('activity_logs', ['branch_id', 'class_id', 'user_id', 'role_id', 'academic_year_id', 'name', 'phone', 'email', 'ip_address', 'user_agent', 'activity', 'status', 'created_by']);
        $this->table('messages', ['subject', 'body', 'academic_year_id', 'status']);
        $this->table('message_relationships', ['message_id', 'owner_id', 'sender_id', 'receiver_id', 'role_id', 'is_read', 'is_trash', 'is_draft', 'status']);
        $this->table('email_settings', ['branch_id', 'status', 'mail_protocol', 'from_address', 'from_name', 'smtp_host', 'smtp_port', 'smtp_crypto', 'smtp_user', 'smtp_pass']);

        (require database_path('migrations/2026_07_16_150535_create_permission_tables.php'))->up();

        DB::table('global_setting')->insert(['brand_title' => 'Test School', 'language' => 'english', 'theme_name' => 'black', 'time_zone' => 'UTC', 'enable_frontend' => 0, 'status' => 1]);
        DB::table('academic_years')->insert(['session_year' => 'January 2026 - December 2026', 'is_running' => 1, 'status' => 1]);
    }

    /**
     * Every column is loosely typed, so the tests can leave out the ones they do not read.
     */
    private function table(string $name, array $columns): void
    {
        Schema::create($name, function (Blueprint $table) use ($columns) {
            $table->id();

            foreach ($columns as $column) {
                $table->text($column)->nullable();
            }

            $table->timestamp('created_at')->nullable();
            $table->timestamp('modified_at')->nullable();
        });
    }
}
