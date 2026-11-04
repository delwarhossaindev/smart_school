<?php

namespace Database\Seeders;

use App\Models\User;
use App\Support\PermissionName;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

/**
 * Fills the Spatie tables from the application's modules, operations, roles, privileges
 * and users. Safe to run again: a role that already has permissions keeps them.
 */
class RolePermissionSeeder extends Seeder
{
    private const GUARD = 'web';

    public function run(): void
    {
        $registrar = app(PermissionRegistrar::class);
        $registrar->forgetCachedPermissions();

        $operations = DB::table('operations')
            ->join('modules', 'modules.id', '=', 'operations.module_id')
            ->get(['operations.id', 'modules.module_slug', 'operations.operation_slug'])
            ->keyBy('id');

        $permissionIds = $this->seedPermissions($operations);

        $this->seedRoles();
        $this->seedRolePermissions($operations, $permissionIds);
        $this->seedUserRoles();

        $registrar->forgetCachedPermissions();
    }

    private function seedPermissions($operations): array
    {
        $names = $operations->flatMap(fn ($operation) => array_map(
            fn ($action) => PermissionName::for($action, $operation->module_slug, $operation->operation_slug),
            array_keys(PermissionName::ACTIONS),
        ))->unique();

        $now = now();
        $missing = $names->diff(Permission::pluck('name'))->map(fn ($name) => [
            'name' => $name,
            'guard_name' => self::GUARD,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        foreach ($missing->chunk(200) as $chunk) {
            Permission::insert($chunk->values()->all());
        }

        return Permission::pluck('id', 'name')->all();
    }

    private function seedRoles(): void
    {
        $existing = Role::pluck('id')->all();

        foreach (DB::table('roles')->get() as $role) {
            if (! in_array($role->id, $existing)) {
                Role::forceCreate([
                    'id' => $role->id,
                    'name' => $role->slug ?: Str::slug($role->name),
                    'guard_name' => self::GUARD,
                ]);
            }
        }
    }

    private function seedRolePermissions($operations, array $permissionIds): void
    {
        $seeded = DB::table('role_has_permissions')->distinct()->pluck('role_id')->all();
        $rows = [];

        foreach (DB::table('privileges')->get() as $privilege) {
            $operation = $operations[$privilege->operation_id] ?? null;

            if (! $operation || in_array($privilege->role_id, $seeded)) {
                continue;
            }

            foreach (PermissionName::ACTIONS as $index => $action) {
                if ($privilege->{'is_'.$action}) {
                    $name = PermissionName::for($index, $operation->module_slug, $operation->operation_slug);
                    $key = $privilege->role_id.':'.$permissionIds[$name];

                    $rows[$key] = ['permission_id' => $permissionIds[$name], 'role_id' => $privilege->role_id];
                }
            }
        }

        foreach (array_chunk(array_values($rows), 500) as $chunk) {
            DB::table('role_has_permissions')->insertOrIgnore($chunk);
        }
    }

    private function seedUserRoles(): void
    {
        $modelType = (new User)->getMorphClass();
        $roleIds = Role::pluck('id')->all();

        DB::table('users')->whereIn('role_id', $roleIds)->select('id', 'role_id')->orderBy('id')
            ->chunk(500, function ($users) use ($modelType) {
                DB::table('model_has_roles')->insertOrIgnore($users->map(fn ($user) => [
                    'role_id' => $user->role_id,
                    'model_type' => $modelType,
                    'model_id' => $user->id,
                ])->all());
            });
    }
}
