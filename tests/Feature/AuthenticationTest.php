<?php

namespace Tests\Feature;

use App\Mail\PasswordResetLink;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    private function role(int $id, string $name, array $permissions = ['dashboard.dashboard.view']): Role
    {
        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::findOrCreate($permission, 'web');
        }

        return Role::forceCreate(['id' => $id, 'name' => $name, 'guard_name' => 'web'])->syncPermissions($permissions);
    }

    private function superAdmin(string $password = 'secret-pass'): User
    {
        $this->role(1, 'super-admin');
        $user = User::forceCreate(['role_id' => 1, 'branch_id' => 0, 'username' => 'root', 'password' => Hash::make($password), 'status' => 1]);
        DB::table('system_admin')->insert(['user_id' => $user->id, 'name' => 'Root', 'email' => 'root@example.com']);

        return $user;
    }

    public function test_a_user_logs_in_with_the_right_password(): void
    {
        $user = $this->superAdmin();

        $this->post('/login', ['username' => 'root', 'password' => 'secret-pass'])->assertRedirect('/dashboard/index');

        $this->assertAuthenticatedAs($user);
        $this->assertSame('1', (string) session('role_id'));
        $this->assertSame('Root', session('name'));
        $this->assertSame('black', session('theme'));
    }

    public function test_a_wrong_password_is_refused(): void
    {
        $this->superAdmin();

        $this->post('/login', ['username' => 'root', 'password' => 'nope'])->assertRedirect('/login')->assertSessionHas('error');

        $this->assertGuest();
    }

    public function test_an_md5_password_still_works_and_is_upgraded_to_bcrypt(): void
    {
        $user = $this->superAdmin();
        $user->forceFill(['password' => md5('old-pass')])->save();

        $this->post('/login', ['username' => 'root', 'password' => 'old-pass'])->assertRedirect('/dashboard/index');

        $this->assertAuthenticatedAs($user);
        $this->assertTrue(Hash::check('old-pass', $user->fresh()->password));
    }

    public function test_a_wrong_password_does_not_upgrade_an_md5_hash(): void
    {
        $user = $this->superAdmin();
        $user->forceFill(['password' => md5('old-pass')])->save();

        $this->post('/login', ['username' => 'root', 'password' => 'nope']);

        $this->assertSame(md5('old-pass'), $user->fresh()->password);
    }

    public function test_an_inactive_user_cannot_log_in(): void
    {
        $user = $this->superAdmin();
        $user->forceFill(['status' => 0])->save();

        $this->post('/login', ['username' => 'root', 'password' => 'secret-pass'])->assertSessionHas('error');

        $this->assertGuest();
    }

    public function test_a_role_without_permissions_cannot_log_in(): void
    {
        Role::forceCreate(['id' => 1, 'name' => 'super-admin', 'guard_name' => 'web']);
        User::forceCreate(['role_id' => 1, 'branch_id' => 0, 'username' => 'root', 'password' => Hash::make('secret-pass'), 'status' => 1]);

        $this->post('/login', ['username' => 'root', 'password' => 'secret-pass'])->assertSessionHas('error');

        $this->assertGuest();
    }

    public function test_a_branch_user_needs_an_active_branch(): void
    {
        $this->role(6, 'accountant');
        User::forceCreate(['role_id' => 6, 'branch_id' => 9, 'username' => 'acc', 'password' => Hash::make('secret-pass'), 'status' => 1]);

        $this->post('/login', ['username' => 'acc', 'password' => 'secret-pass'])->assertSessionHas('error');

        $this->assertGuest();
    }

    public function test_a_user_created_by_a_legacy_module_gets_its_role_on_login(): void
    {
        $this->role(6, 'accountant');
        DB::table('schools')->insert(['id' => 9, 'branch_name' => 'Main', 'branch_url' => 'main', 'theme_name' => 'red', 'status' => 1]);
        $user = User::forceCreate(['role_id' => 6, 'branch_id' => 9, 'username' => 'acc', 'password' => Hash::make('secret-pass'), 'status' => 1]);

        $this->post('/login', ['username' => 'acc', 'password' => 'secret-pass'])->assertRedirect('/dashboard/index');

        $this->assertTrue($user->fresh()->hasRole('accountant'));
        $this->assertSame('red', session('theme'));
        $this->assertSame(1, DB::table('activity_logs')->where('user_id', $user->id)->count());
    }

    public function test_logout_requires_post_and_ends_the_session(): void
    {
        $user = $this->superAdmin();

        $this->actingAs($user)->get('/logout')->assertStatus(200);
        $this->assertAuthenticated();

        $this->actingAs($user)->post('/logout')->assertRedirect('/login');
        $this->assertGuest();
    }

    public function test_a_password_can_be_reset_with_the_emailed_link(): void
    {
        Mail::fake();
        $user = $this->superAdmin();

        $this->post('/forgot-password', ['username' => 'root'])->assertSessionHas('success');

        $url = null;
        Mail::assertSent(PasswordResetLink::class, function ($mail) use (&$url) {
            $url = $mail->url;

            return $mail->hasTo('root@example.com');
        });

        $this->assertNotSame(basename($url), $user->fresh()->reset_key, 'The token must be stored hashed.');

        $this->get($url)->assertOk();
        $this->post('/reset-password', ['token' => basename($url), 'password' => 'new-pass', 'conf_password' => 'new-pass'])->assertRedirect('/login');

        $fresh = $user->fresh();
        $this->assertTrue(Hash::check('new-pass', $fresh->password));
        $this->assertNull($fresh->reset_key);

        $this->get($url)->assertRedirect('/login');
    }

    public function test_a_reset_with_a_wrong_token_changes_nothing(): void
    {
        $user = $this->superAdmin();

        $this->post('/reset-password', ['token' => 'wrong', 'password' => 'new-pass', 'conf_password' => 'new-pass'])->assertRedirect('/login');

        $this->assertTrue(Hash::check('secret-pass', $user->fresh()->password));
    }
}
