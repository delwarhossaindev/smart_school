<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Services\UserSession;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class LoginController extends Controller
{
    private const SUPER_ADMIN_ROLE = 1;

    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request, UserSession $session): RedirectResponse
    {
        $user = User::where('username', $request->input('username'))->first();

        if (! $user || ! $user->checkPassword($request->input('password'))) {
            return $this->refuse('invalid_login');
        }

        $school = null;

        if ((int) $user->role_id !== self::SUPER_ADMIN_ROLE) {
            $school = DB::table('schools')->where(['status' => 1, 'id' => $user->branch_id])->first();

            if (! $school) {
                return $this->refuse('invalid_login');
            }
        }

        if (! $user->status) {
            return $this->refuse('user_active_status');
        }

        $role = Role::find($user->role_id);

        if (! $role || $role->permissions()->doesntExist()) {
            return $this->refuse('privilege_not_setting');
        }

        // The legacy modules create users without touching the Spatie tables.
        if (! $user->hasRole($role)) {
            $user->assignRole($role);
        }

        $session->start($user, $school);

        return redirect('/dashboard/index')->with('success', __('login_success'));
    }

    public function destroy(UserSession $session): RedirectResponse
    {
        $branchId = Auth::user()?->branch_id;
        $school = $branchId ? DB::table('schools')->where(['status' => 1, 'id' => $branchId])->first() : null;

        $session->end();

        return $school && $school->enable_frontend
            ? redirect($school->branch_url)
            : redirect()->route('login');
    }

    private function refuse(string $message): RedirectResponse
    {
        return redirect()->route('login')->with('error', __($message))->onlyInput('username');
    }
}
