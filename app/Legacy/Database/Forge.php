<?php

namespace App\Legacy\Database;

use Illuminate\Support\Facades\DB;
use Throwable;

class Forge
{
    public function add_column($table, array $fields)
    {
        return $this->alter($table, 'ADD', $fields);
    }

    public function modify_column($table, array $fields)
    {
        return $this->alter($table, 'CHANGE', $fields);
    }

    public function drop_column($table, $column)
    {
        return $this->run("ALTER TABLE `{$table}` DROP COLUMN `{$column}`");
    }

    private function alter(string $table, string $action, array $fields): bool
    {
        $clauses = [];

        foreach ($fields as $name => $field) {
            $target = $action === 'CHANGE' ? "`{$name}` `".($field['name'] ?? $name).'`' : "`{$name}`";
            $clauses[] = "{$action} {$target} ".$this->definition($field);
        }

        return $this->run("ALTER TABLE `{$table}` ".implode(', ', $clauses));
    }

    private function definition(array $field): string
    {
        $sql = strtoupper($field['type'] ?? 'TEXT');

        if (isset($field['constraint'])) {
            $sql .= '('.$field['constraint'].')';
        }

        $sql .= ! empty($field['null']) ? ' NULL' : ' NOT NULL';

        if (array_key_exists('default', $field)) {
            $sql .= ' DEFAULT '.($field['default'] === null ? 'NULL' : DB::getPdo()->quote((string) $field['default']));
        }

        return $sql;
    }

    private function run(string $sql): bool
    {
        try {
            return DB::statement($sql);
        } catch (Throwable $e) {
            log_message('error', $e->getMessage());

            return false;
        }
    }
}
