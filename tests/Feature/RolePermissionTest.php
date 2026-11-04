<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserRole;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Tests\TestCase;

class RolePermissionTest extends TestCase
{
    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        DB::table('modules')->insert(['id' => 1, 'module_name' => 'Administrator', 'module_slug' => 'administrator', 'status' => 1]);
        DB::table('roles')->insert([
            ['id' => 1, 'slug' => 'super-admin', 'name' => 'Super Admin', 'is_default' => 1, 'status' => 1],
            ['id' => 2, 'slug' => 'admin', 'name' => 'Admin', 'is_default' => 1, 'status' => 1],
        ]);

        foreach (['role', 'permission'] as $id => $slug) {
            DB::table('operations')->insert(['id' => $id + 1, 'module_id' => 1, 'operation_name' => ucfirst($slug), 'operation_slug' => $slug, 'is_view_vissible' => 1, 'is_add_vissible' => 1, 'is_edit_vissible' => 1, 'is_delete_vissible' => 1, 'status' => 1]);
            DB::table('privileges')->insert(['role_id' => 1, 'operation_id' => $id + 1, 'is_add' => 1, 'is_edit' => 1, 'is_view' => 1, 'is_delete' => 1]);
            DB::table('privileges')->insert(['role_id' => 2, 'operation_id' => $id + 1, 'is_add' => 0, 'is_edit' => 0, 'is_view' => 1, 'is_delete' => 0]);
        }

        $this->admin = User::forceCreate(['role_id' => 1, 'branch_id' => 0, 'username' => 'root', 'password' => Hash::make('x'), 'status' => 1]);

        $this->seed(RolePermissionSeeder::class);
        session(['role_id' => 1]);
    }

    public function test_the_seeder_copies_privileges_into_spatie(): void
    {
        $this->assertSame(8, Permission::count());
        $this->assertSame(2, Role::count());
        $this->assertSame('admin', Role::find(2)->name);
        $this->assertTrue(Role::find(1)->hasPermissionTo('administrator.role.delete'));
        $this->assertTrue(Role::find(2)->hasPermissionTo('administrator.role.view'));
        $this->assertFalse(Role::find(2)->hasPermissionTo('administrator.role.delete'));
        $this->assertTrue($this->admin->fresh()->hasRole('super-admin'));
    }

    public function test_running_the_seeder_again_keeps_changes_made_in_the_page(): void
    {
        Role::find(2)->revokePermissionTo('administrator.role.view');
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $this->seed(RolePermissionSeeder::class);

        $this->assertFalse(Role::find(2)->fresh()->hasPermissionTo('administrator.role.view'));
        $this->assertSame(8, Permission::count());
    }

    public function test_has_permission_helper_uses_spatie(): void
    {
        require_once app_path('Legacy/constants.php');
        require_once app_path('Legacy/helpers/util_helper.php');

        $this->actingAs($this->admin);

        $this->assertTrue(has_permission(DELETE, 'administrator', 'role'));
        $this->assertFalse(has_permission(VIEW, 'administrator', 'no_such_operation'));
    }

    public function test_guests_are_sent_to_login(): void
    {
        $this->get('/administrator/roles')->assertRedirect('/login');
    }

    public function test_other_roles_cannot_open_the_pages(): void
    {
        $user = User::forceCreate(['role_id' => 2, 'branch_id' => 1, 'username' => 'a', 'password' => 'x', 'status' => 1]);
        $user->assignRole('admin');

        $this->actingAs($user)->get('/administrator/roles')->assertRedirect('/dashboard/index')->assertSessionHas('error');
        $this->actingAs($user)->put('/administrator/permissions/2', ['permissions' => ['administrator.role.delete']])->assertRedirect('/dashboard/index');

        $this->assertFalse(Role::find(2)->fresh()->hasPermissionTo('administrator.role.delete'));
    }

    public function test_a_role_is_created_in_both_tables_with_the_same_id(): void
    {
        $this->actingAs($this->admin)->post('/administrator/roles', ['name' => 'Exam Officer', 'note' => 'n'])->assertRedirect('/administrator/roles');

        $role = UserRole::where('name', 'Exam Officer')->firstOrFail();
        $this->assertSame('exam-officer', $role->slug);
        $this->assertSame('exam-officer', Role::findById($role->id, 'web')->name);
    }

    public function test_a_duplicate_role_name_is_refused(): void
    {
        $this->actingAs($this->admin)->post('/administrator/roles', ['name' => 'Admin'])->assertSessionHasErrors('name');

        $this->assertSame(2, UserRole::count());
    }

    public function test_a_role_can_keep_its_own_name_when_edited(): void
    {
        $this->actingAs($this->admin)->put('/administrator/roles/2', ['name' => 'Admin', 'note' => 'changed'])->assertSessionHasNoErrors();

        $this->assertSame('changed', UserRole::find(2)->note);
    }

    public function test_renaming_a_role_renames_the_spatie_role(): void
    {
        $this->actingAs($this->admin)->put('/administrator/roles/2', ['name' => 'Head Admin'])->assertSessionHasNoErrors();

        $this->assertSame('head-admin', Role::find(2)->name);
    }

    public function test_a_default_role_and_a_role_in_use_cannot_be_deleted(): void
    {
        $this->actingAs($this->admin)->delete('/administrator/roles/1')->assertSessionHas('error');

        DB::table('roles')->insert(['id' => 3, 'slug' => 'clerk', 'name' => 'Clerk', 'is_default' => 0, 'status' => 1]);
        Role::forceCreate(['id' => 3, 'name' => 'clerk', 'guard_name' => 'web']);
        $clerk = User::forceCreate(['role_id' => 3, 'branch_id' => 1, 'username' => 'c', 'password' => 'x', 'status' => 1]);

        $this->actingAs($this->admin)->delete('/administrator/roles/3')->assertSessionHas('error');
        $this->assertNotNull(Role::find(3));

        $clerk->delete();
        $this->actingAs($this->admin)->delete('/administrator/roles/3')->assertSessionHas('success');
        $this->assertNull(Role::find(3));
        $this->assertNull(UserRole::find(3));
    }

    public function test_permissions_are_saved_to_spatie(): void
    {
        $this->actingAs($this->admin)->put('/administrator/permissions/2', [
            'permissions' => ['administrator.role.add', 'administrator.permission.view'],
        ])->assertRedirect('/administrator/permissions/2');

        $names = Role::find(2)->fresh()->permissions->pluck('name')->sort()->values()->all();

        $this->assertSame(['administrator.permission.view', 'administrator.role.add'], $names);
    }

    public function test_unknown_permissions_are_refused(): void
    {
        $this->actingAs($this->admin)->put('/administrator/permissions/2', ['permissions' => ['made.up.name']])->assertSessionHasErrors();

        $this->assertTrue(Role::find(2)->fresh()->hasPermissionTo('administrator.role.view'));
    }

    public function test_the_super_admin_cannot_lose_access_to_the_permission_page(): void
    {
        $this->actingAs($this->admin)->put('/administrator/permissions/1', ['permissions' => []]);

        $role = Role::find(1)->fresh();
        $this->assertTrue($role->hasPermissionTo('administrator.permission.edit'));
        $this->assertFalse($role->hasPermissionTo('administrator.role.delete'));
    }

    public function test_the_pages_render_inside_the_layout(): void
    {
        $this->actingAs($this->admin);

        $this->get('/administrator/roles')->assertOk()->assertSee('Super Admin')->assertSee('name="_token"', false);
        $this->get('/administrator/roles/2/edit')->assertOk()->assertSee('tab_edit_role', false);
        $this->get('/administrator/permissions')->assertOk();
        $this->get('/administrator/permissions/2')->assertOk()->assertSee('administrator.role.view')->assertSee('checked', false);
    }
}
