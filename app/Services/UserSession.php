<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Logs a user in and out. Besides Laravel's guard, this writes the session keys that the
 * legacy modules read, such as role_id, branch_id and theme.
 */
class UserSession
{
    public function start(User $user, ?object $school): void
    {
        Auth::login($user);
        request()->session()->regenerate();

        $profile = $user->profile();
        $session = request()->session();

        $session->put([
            'id' => $user->id,
            'role_id' => $user->role_id,
            'username' => $user->username,
            'branch_id' => $user->branch_id,
        ]);

        foreach (['name', 'phone', 'email', 'photo', 'user_id'] as $key) {
            if (isset($profile->{$key})) {
                $session->put($key, $profile->{$key});
            }
        }

        if (isset($profile->id)) {
            $session->put('profile_id', $profile->id);
        }

        if ((int) $user->role_id === 4 && $profile) {
            $enrollment = DB::table('enrollments')->where('student_id', $profile->id)->first();

            $session->put('class_id', $enrollment->class_id ?? null);
            $session->put('section_id', $enrollment->section_id ?? null);
        }

        if ($school) {
            $session->put([
                'branch_name' => $school->branch_name,
                'theme' => $school->theme_name,
                'front_branch_id' => $user->branch_id,
            ]);
        } else {
            $session->put('theme', DB::table('global_setting')->value('theme_name'));
        }

        $user->forceFill(['last_logged_in' => now()])->save();

        $this->log($user, $profile, 'Has been logged in');
    }

    public function end(): void
    {
        if ($user = Auth::user()) {
            $this->log($user, $user->profile(), 'Has been logged out');
        }

        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }

    /**
     * As create_log() does, this only records users who belong to a branch.
     */
    private function log(User $user, ?object $profile, string $activity): void
    {
        if ((int) $user->role_id === 1 || ! $user->branch_id) {
            return;
        }

        DB::table('activity_logs')->insert([
            'branch_id' => $user->branch_id,
            'class_id' => request()->session()->get('class_id'),
            'user_id' => $user->id,
            'role_id' => $user->role_id,
            'academic_year_id' => DB::table('academic_years')->where(['status' => 1, 'is_running' => 1])->value('id'),
            'name' => $profile->name ?? null,
            'phone' => $profile->phone ?? null,
            'email' => $profile->email ?? null,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'activity' => $activity,
            'status' => 1,
            'created_at' => now(),
            'created_by' => $user->id,
        ]);
    }
}
