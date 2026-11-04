<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * An account in the application's users table. users.role_id is the same id as the
 * user's Spatie role, because the legacy modules still read it directly.
 */
class User extends Authenticatable
{
    use HasApiTokens, HasRoles;

    public const UPDATED_AT = 'modified_at';

    protected $guarded = [];

    protected $hidden = [
        'password',
        'temp_password',
        'reset_key',
    ];

    /**
     * Older rows hold an md5 hash, which Hash::check() refuses to read. They are replaced
     * with a bcrypt hash the first time the password is confirmed.
     */
    public function checkPassword(string $password): bool
    {
        if (preg_match('/^[a-f0-9]{32}$/', $this->password)) {
            if (! hash_equals($this->password, md5($password))) {
                return false;
            }

            $this->forceFill(['password' => Hash::make($password)])->save();

            return true;
        }

        return Hash::check($password, $this->password);
    }

    /**
     * The row holding the user's name and contact details. Its table depends on the role.
     */
    public function profile(): ?object
    {
        $table = match ((int) $this->role_id) {
            1 => 'system_admin',
            3 => 'guardians',
            4 => 'students',
            5 => 'teachers',
            default => 'employees',
        };

        return DB::table($table)->where('user_id', $this->id)->first();
    }
}
