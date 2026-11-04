<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Legacy\LayoutHost;
use App\Models\UserRole;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class PermissionController extends Controller
{
    /**
     * Without these the super admin could lock everyone out of this page.
     */
    private const ALWAYS_KEPT_BY_SUPER_ADMIN = [
        'administrator.permission.view',
        'administrator.permission.edit',
    ];

    private const SUPER_ADMIN_ROLE = 1;

    public function index(): Response
    {
        return $this->page();
    }

    public function show(UserRole $role): Response
    {
        return $this->page($role);
    }

    public function update(Request $request, UserRole $role): RedirectResponse
    {
        $validated = $request->validate([
            'permissions' => ['array'],
            'permissions.*' => ['string', Rule::exists('permissions', 'name')],
        ]);

        $names = $validated['permissions'] ?? [];

        if ($role->id === self::SUPER_ADMIN_ROLE) {
            $names = array_merge($names, self::ALWAYS_KEPT_BY_SUPER_ADMIN);
        }

        Role::findById($role->id, 'web')->syncPermissions(array_unique($names));

        return redirect()->route('permissions.show', $role)->with('success', __('update_success'));
    }

    private function page(?UserRole $role = null): Response
    {
        $roles = UserRole::where('status', 1)->orderBy('id')->get();
        $data = ['roles' => $roles, 'role' => $role];

        if ($role) {
            $operations = DB::table('operations')->where('status', 1)->orderBy('id')->get()->groupBy('module_id');

            $data['modules'] = DB::table('modules')->where('status', 1)->orderBy('id')->get()
                ->each(fn ($module) => $module->operations = $operations->get($module->id, collect()));

            $data['granted'] = Role::findById($role->id, 'web')->permissions->pluck('name')->flip();
        }

        return LayoutHost::respond(
            __('manage_role_permission'),
            view('administrator.permission.index', $data),
            'administrator',
            'permission',
        );
    }
}
