<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Legacy\LayoutHost;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    private const GUARD = 'web';

    public function index(): Response
    {
        return $this->page(__('manage_user_role'), ['list' => true]);
    }

    public function store(RoleRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            $role = UserRole::create([
                'name' => $request->input('name'),
                'slug' => $this->slug($request->input('name')),
                'note' => $request->input('note'),
                'is_default' => 0,
                'is_super_admin' => 0,
                'status' => 1,
                'created_by' => Auth::id(),
                'modified_by' => Auth::id(),
            ]);

            // The ids match, because users.role_id is read as both.
            Role::forceCreate(['id' => $role->id, 'name' => $role->slug, 'guard_name' => self::GUARD]);
        });

        return redirect()->route('roles.index')->with('success', __('insert_success'));
    }

    public function edit(UserRole $role): Response
    {
        return $this->page(__('edit'), ['edit' => true, 'role' => $role]);
    }

    public function update(RoleRequest $request, UserRole $role): RedirectResponse
    {
        DB::transaction(function () use ($request, $role) {
            $role->update([
                'name' => $request->input('name'),
                'slug' => $this->slug($request->input('name')),
                'note' => $request->input('note'),
                'modified_by' => Auth::id(),
            ]);

            Role::findById($role->id, self::GUARD)->update(['name' => $role->slug]);
        });

        return redirect()->route('roles.index')->with('success', __('update_success'));
    }

    public function destroy(UserRole $role): RedirectResponse
    {
        if ($role->is_default || User::where('role_id', $role->id)->exists()) {
            return redirect()->route('roles.index')->with('error', __('this_user_role_already_used'));
        }

        DB::transaction(function () use ($role) {
            Role::findById($role->id, self::GUARD)->delete();
            DB::table('activity_logs')->where('role_id', $role->id)->delete();
            DB::table('privileges')->where('role_id', $role->id)->delete();
            $role->delete();
        });

        return redirect()->route('roles.index')->with('success', __('delete_success'));
    }

    private function page(string $title, array $data): Response
    {
        $roles = UserRole::where('status', 1)->orderBy('id')->get();

        return LayoutHost::respond($title, view('administrator.role.index', $data + ['roles' => $roles]), 'administrator', 'role');
    }

    private function slug(string $name): string
    {
        return Str::slug($name) ?: Str::random(8);
    }
}
