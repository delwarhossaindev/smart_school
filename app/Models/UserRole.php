<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * A row of the application's roles table. Its id matches a Spatie role, which holds the
 * permissions. This table holds the note and the is_default flag.
 */
class UserRole extends Model
{
    public const UPDATED_AT = 'modified_at';

    protected $table = 'roles';

    protected $guarded = [];
}
