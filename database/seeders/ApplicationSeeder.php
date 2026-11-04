<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 * The records the application needs before anyone can log in, for a database created by
 * the migrations without a dump. Run it with: php artisan db:seed --class=ApplicationSeeder
 */
class ApplicationSeeder extends Seeder
{
    /**
     * The ids are fixed by the role constants in app/Legacy/constants.php.
     */
    private const ROLES = [
        1 => 'Super Admin',
        2 => 'Admin',
        3 => 'Guardian',
        4 => 'Student',
        5 => 'Teacher',
        6 => 'Accountant',
        7 => 'Librarian',
        8 => 'Receptionist',
        9 => 'Staff',
    ];

    private const THEME = 'dodger-blue';

    public function run(): void
    {
        // Most of the tables are MyISAM, so a transaction could not undo a second run.
        if (DB::table('users')->exists() || DB::table('global_setting')->exists()) {
            $this->command->warn('The database already has users or settings. Nothing was seeded.');

            return;
        }

        $name = config('app.name');
        $now = now()->format('Y-m-d H:i:s');
        $year = now()->format('Y');
        $stamps = ['created_at' => $now, 'modified_at' => $now, 'created_by' => 1, 'modified_by' => 1];

        DB::table('schools')->insert([
            'id' => 1,
            'branch_name' => $name,
            'branch_url' => Str::slug($name),
            'branch_code' => 'MAIN',
            'registration_date' => now()->format('Y-m-d'),
            'address' => 'Dhaka, Bangladesh',
            'email' => 'admin@example.com',
            'currency' => 'BDT',
            'currency_symbol' => '৳',
            'footer' => $name,
            'enable_frontend' => 0,
            'language' => 'english',
            'theme_name' => self::THEME,
            'is_default' => 1,
            'status' => 1,
        ] + $stamps);

        DB::table('global_setting')->insert([
            'brand_name' => $name,
            'brand_title' => $name,
            'language' => 'english',
            'enable_rtl' => 0,
            'enable_frontend' => 0,
            'theme_name' => self::THEME,
            'date_format' => 'Y-m-d',
            'time_zone' => 'Asia/Dhaka',
            'brand_footer' => $name,
            'currency' => 'BDT',
            'currency_symbol' => '৳',
            'default_school_id' => 1,
            'status' => 1,
        ] + $stamps);

        DB::table('academic_years')->insert([
            'session_year' => "January $year - December $year",
            'start_year' => $year,
            'end_year' => $year,
            'is_running' => 1,
            'status' => 1,
        ] + $stamps);

        foreach (self::ROLES as $id => $role) {
            DB::table('roles')->insert([
                'id' => $id,
                'slug' => Str::slug($role),
                'name' => $role,
                'is_default' => 1,
                'is_super_admin' => $id === 1 ? 1 : 0,
                'status' => 1,
            ] + $stamps);
        }

        $this->seedThemes($stamps);
        $this->seedPermissions($stamps);

        $password = env('SEED_ADMIN_PASSWORD') ?: Str::random(16);

        $userId = DB::table('users')->insertGetId([
            'role_id' => 1,
            'branch_id' => 0,
            'username' => 'superadmin',
            // Auth::index compares md5 hashes.
            'password' => md5($password),
            'status' => 1,
            'last_logged_in' => $now,
        ] + $stamps);

        DB::table('system_admin')->insert([
            'user_id' => $userId,
            'is_default' => 1,
            'national_id' => '',
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'phone' => '',
            'dob' => '2000-01-01',
            'status' => 1,
        ] + $stamps);

        $this->command->info('Seeded. Log in at /login');
        $this->command->info('Username: superadmin');
        $this->command->info("Password: $password");
    }

    /**
     * One theme for each stylesheet in public/assets/css/theme, in its first colour.
     */
    private function seedThemes(array $stamps): void
    {
        foreach (File::glob(public_path('assets/css/theme/*.css')) as $file) {
            $slug = pathinfo($file, PATHINFO_FILENAME);
            preg_match('/#[0-9a-fA-F]{6}/', File::get($file), $color);

            DB::table('themes')->insert([
                'name' => Str::headline($slug),
                'slug' => $slug,
                'color_code' => $color[0] ?? '#333333',
                'is_active' => $slug === self::THEME ? 1 : 0,
                'status' => 1,
            ] + $stamps);
        }
    }

    /**
     * has_permission() reads resources/legacy/custom.php, which MY_Controller::update_config
     * writes from the privileges table. This fills the tables back in from that file.
     */
    private function seedPermissions(array $stamps): void
    {
        $config = [];
        require resource_path('legacy/custom.php');

        $privileges = [];

        foreach ($config as $moduleKey => $operations) {
            $moduleSlug = substr($moduleKey, 3);

            if ($moduleSlug === '') {
                continue;
            }

            $moduleId = DB::table('modules')->insertGetId([
                'module_name' => Str::headline($moduleSlug),
                'module_slug' => $moduleSlug,
                'status' => 1,
            ] + $stamps);

            foreach ($operations as $operationSlug => $roles) {
                // Each value is add|edit|view|delete.
                $rows = array_map(fn ($value) => explode('|', $value), $roles);

                $operationId = DB::table('operations')->insertGetId([
                    'module_id' => $moduleId,
                    'operation_name' => Str::headline($operationSlug),
                    'operation_slug' => $operationSlug,
                    'is_add_vissible' => (int) max(array_column($rows, 0)),
                    'is_edit_vissible' => (int) max(array_column($rows, 1)),
                    'is_view_vissible' => (int) max(array_column($rows, 2)),
                    'is_delete_vissible' => (int) max(array_column($rows, 3)),
                    'status' => 1,
                ] + $stamps);

                foreach ($rows as $roleId => $row) {
                    $privileges[] = [
                        'role_id' => $roleId,
                        'operation_id' => $operationId,
                        'is_add' => $row[0],
                        'is_edit' => $row[1],
                        'is_view' => $row[2],
                        'is_delete' => $row[3],
                        'status' => 1,
                    ] + $stamps;
                }
            }
        }

        foreach (array_chunk($privileges, 200) as $chunk) {
            DB::table('privileges')->insert($chunk);
        }
    }
}
