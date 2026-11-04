<?php

namespace App\Support;

/**
 * Permissions are named module.operation.action, for example academic.classes.view.
 */
class PermissionName
{
    /**
     * Keyed by the legacy ADD, EDIT, VIEW and DELETE constants.
     */
    public const ACTIONS = ['add', 'edit', 'view', 'delete'];

    public static function for(int|string $action, ?string $module, ?string $operation): string
    {
        return ($module ?: $operation).'.'.$operation.'.'.self::ACTIONS[(int) $action];
    }
}
