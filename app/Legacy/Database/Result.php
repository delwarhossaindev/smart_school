<?php

namespace App\Legacy\Database;

class Result
{
    public function __construct(private array $rows)
    {
    }

    public function result($type = 'object')
    {
        return $type === 'array' ? $this->result_array() : $this->rows;
    }

    public function result_array()
    {
        return array_map(fn ($row) => (array) $row, $this->rows);
    }

    public function row($n = 0, $type = 'object')
    {
        if (is_string($n) && ! is_numeric($n)) {
            return $this->rows[0]->{$n} ?? null;
        }

        $row = $this->rows[(int) $n] ?? null;

        return $type === 'array' && $row ? (array) $row : $row;
    }

    public function row_array($n = 0)
    {
        return isset($this->rows[$n]) ? (array) $this->rows[$n] : null;
    }

    public function num_rows()
    {
        return count($this->rows);
    }

    public function num_fields()
    {
        return isset($this->rows[0]) ? count((array) $this->rows[0]) : 0;
    }

    public function free_result()
    {
    }
}
