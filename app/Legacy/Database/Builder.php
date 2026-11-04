<?php

namespace App\Legacy\Database;

use Illuminate\Support\Facades\DB;
use Throwable;

/**
 * The CodeIgniter query builder API, generating SQL in the same clause order and running
 * it through Laravel's database connection. As under CI's production settings, a failed
 * query returns FALSE instead of throwing, and legacy code relies on that.
 */
class Builder
{
    private array $select = [];
    private bool $distinct = false;
    private array $from = [];
    private array $joins = [];
    private array $where = [];
    private array $whereBindings = [];
    private array $groupBy = [];
    private array $having = [];
    private array $havingBindings = [];
    private array $orderBy = [];
    private ?int $limit = null;
    private ?int $offset = null;
    private array $set = [];

    private string $lastQuery = '';
    private int $affectedRows = 0;
    private array $lastError = ['code' => 0, 'message' => ''];

    public function select($select = '*', $escape = null)
    {
        foreach ((array) $select as $item) {
            $this->select[] = $escape === false ? $item : $this->protectList($item);
        }

        return $this;
    }

    public function select_max($column, $alias = '')
    {
        return $this->aggregate('MAX', $column, $alias);
    }

    public function select_min($column, $alias = '')
    {
        return $this->aggregate('MIN', $column, $alias);
    }

    public function select_avg($column, $alias = '')
    {
        return $this->aggregate('AVG', $column, $alias);
    }

    public function select_sum($column, $alias = '')
    {
        return $this->aggregate('SUM', $column, $alias);
    }

    private function aggregate(string $function, string $column, string $alias)
    {
        $alias = $alias ?: strtolower(preg_replace('/.*\./', '', $column));
        $this->select[] = $function.'('.$this->protect($column).') AS `'.$alias.'`';

        return $this;
    }

    public function distinct($value = true)
    {
        $this->distinct = (bool) $value;

        return $this;
    }

    public function from($from)
    {
        foreach ((array) $from as $item) {
            foreach (explode(',', $item) as $table) {
                $this->from[] = $this->protectTable(trim($table));
            }
        }

        return $this;
    }

    public function join($table, $condition, $type = '', $escape = null)
    {
        $type = strtoupper(trim((string) $type));
        $type = in_array($type, ['LEFT', 'RIGHT', 'OUTER', 'INNER', 'LEFT OUTER', 'RIGHT OUTER'], true) ? $type.' ' : '';

        if ($escape !== false) {
            $condition = $this->protectQualified($condition);
        }

        $this->joins[] = $type.'JOIN '.$this->protectTable(trim($table)).' ON '.$condition;

        return $this;
    }

    public function where($key, $value = null, $escape = null)
    {
        return $this->addWhere($key, $value, 'AND ', $escape);
    }

    public function or_where($key, $value = null, $escape = null)
    {
        return $this->addWhere($key, $value, 'OR ', $escape);
    }

    private function addWhere($key, $value, string $type, $escape)
    {
        foreach (is_array($key) ? $key : [$key => $value] as $column => $item) {
            $this->where[] = $this->prefix($type).$this->condition($column, $item, $escape, $this->whereBindings);
        }

        return $this;
    }

    public function where_in($key = null, $values = null, $escape = null)
    {
        return $this->addIn($key, $values, false, 'AND ');
    }

    public function or_where_in($key = null, $values = null, $escape = null)
    {
        return $this->addIn($key, $values, false, 'OR ');
    }

    public function where_not_in($key = null, $values = null, $escape = null)
    {
        return $this->addIn($key, $values, true, 'AND ');
    }

    public function or_where_not_in($key = null, $values = null, $escape = null)
    {
        return $this->addIn($key, $values, true, 'OR ');
    }

    private function addIn($key, $values, bool $not, string $type)
    {
        if ($key === null || $values === null) {
            return $this;
        }

        $values = array_values((array) $values);
        $placeholders = implode(', ', array_fill(0, count($values), '?'));

        foreach ($values as $value) {
            $this->whereBindings[] = $this->bindable($value);
        }

        $this->where[] = $this->prefix($type).$this->protect($key).($not ? ' NOT' : '').' IN('.$placeholders.')';

        return $this;
    }

    public function like($field, $match = '', $side = 'both', $escape = null)
    {
        return $this->addLike($field, $match, 'AND ', $side, '');
    }

    public function or_like($field, $match = '', $side = 'both', $escape = null)
    {
        return $this->addLike($field, $match, 'OR ', $side, '');
    }

    public function not_like($field, $match = '', $side = 'both', $escape = null)
    {
        return $this->addLike($field, $match, 'AND ', $side, 'NOT ');
    }

    public function or_not_like($field, $match = '', $side = 'both', $escape = null)
    {
        return $this->addLike($field, $match, 'OR ', $side, 'NOT ');
    }

    private function addLike($field, $match, string $type, string $side, string $not)
    {
        foreach (is_array($field) ? $field : [$field => $match] as $column => $value) {
            $value = str_replace(['!', '%', '_'], ['!!', '!%', '!_'], (string) $value);
            $value = match (strtolower($side)) {
                'none' => $value,
                'before' => '%'.$value,
                'after' => $value.'%',
                default => '%'.$value.'%',
            };

            $this->whereBindings[] = $value;
            $this->where[] = $this->prefix($type).$this->protect($column).' '.$not."LIKE ? ESCAPE '!'";
        }

        return $this;
    }

    private function prefix(string $type): string
    {
        return $this->where === [] ? '' : $type;
    }

    public function group_by($by, $escape = null)
    {
        foreach (is_array($by) ? $by : explode(',', $by) as $item) {
            $item = trim($item);

            if ($item !== '') {
                $this->groupBy[] = $escape === false ? $item : $this->protect($item);
            }
        }

        return $this;
    }

    public function having($key, $value = null, $escape = null)
    {
        foreach (is_array($key) ? $key : [$key => $value] as $column => $item) {
            $this->having[] = ($this->having ? 'AND ' : '').$this->condition($column, $item, $escape, $this->havingBindings);
        }

        return $this;
    }

    public function order_by($orderBy, $direction = '', $escape = null)
    {
        $direction = strtoupper(trim((string) $direction));

        if ($direction === 'RANDOM') {
            $this->orderBy[] = 'RAND()';

            return $this;
        }

        if (empty($orderBy)) {
            return $this;
        }

        $direction = in_array($direction, ['ASC', 'DESC'], true) ? ' '.$direction : '';

        if ($escape === false) {
            $this->orderBy[] = $orderBy.$direction;

            return $this;
        }

        foreach (explode(',', $orderBy) as $item) {
            $item = trim($item);

            if (preg_match('/^(.+?)\s+(ASC|DESC)$/i', $item, $match)) {
                $this->orderBy[] = $this->protect($match[1]).' '.strtoupper($match[2]);
            } else {
                $this->orderBy[] = $this->protect($item).$direction;
            }
        }

        return $this;
    }

    public function limit($value, $offset = 0)
    {
        if ($value !== null) {
            $this->limit = (int) $value;
        }
        if (! empty($offset)) {
            $this->offset = (int) $offset;
        }

        return $this;
    }

    public function offset($offset)
    {
        if (! empty($offset)) {
            $this->offset = (int) $offset;
        }

        return $this;
    }

    public function set($key, $value = '', $escape = null)
    {
        foreach (is_array($key) || is_object($key) ? (array) $key : [$key => $value] as $column => $item) {
            $this->set[$column] = [$item, $escape !== false];
        }

        return $this;
    }

    public function get($table = '', $limit = null, $offset = null)
    {
        if ($table !== '') {
            $this->from($table);
        }
        if ($limit !== null) {
            $this->limit($limit, $offset);
        }

        [$sql, $bindings] = $this->compileSelect();
        $this->reset();

        return $this->runSelect($sql, $bindings);
    }

    public function get_where($table = '', $where = null, $limit = null, $offset = null)
    {
        if ($table !== '') {
            $this->from($table);
        }
        if ($where !== null) {
            $this->where($where);
        }
        if ($limit !== null) {
            $this->limit($limit, $offset);
        }

        [$sql, $bindings] = $this->compileSelect();
        $this->reset();

        return $this->runSelect($sql, $bindings);
    }

    public function get_compiled_select($table = '', $reset = true)
    {
        if ($table !== '') {
            $this->from($table);
        }

        [$sql, $bindings] = $this->compileSelect();

        if ($reset) {
            $this->reset();
        }

        return $this->interpolate($sql, $bindings);
    }

    public function count_all_results($table = '', $reset = true)
    {
        if ($table !== '') {
            $this->from($table);
        }

        $orderBy = $this->orderBy;
        $select = $this->select;
        $this->orderBy = [];

        if ($this->distinct || $this->groupBy) {
            [$inner, $bindings] = $this->compileSelect();
            $sql = 'SELECT COUNT(*) AS `numrows` FROM ('.$inner.') CI_count_all_results';
        } else {
            $this->select = ['COUNT(*) AS `numrows`'];
            [$sql, $bindings] = $this->compileSelect();
        }

        if ($reset) {
            $this->reset();
        } else {
            $this->orderBy = $orderBy;
            $this->select = $select;
        }

        $result = $this->runSelect($sql, $bindings);

        return $result ? (int) $result->row()->numrows : 0;
    }

    public function count_all($table = '')
    {
        $result = $this->runSelect('SELECT COUNT(*) AS `numrows` FROM '.$this->protectTable($table), []);

        return $result ? (int) $result->row()->numrows : 0;
    }

    public function insert($table = '', $set = null, $escape = null)
    {
        if ($set !== null) {
            $this->set($set, '', $escape);
        }

        $columns = $placeholders = $bindings = [];

        foreach ($this->set as $column => [$value, $bind]) {
            $columns[] = $this->protect($column);
            $placeholders[] = $bind ? '?' : $value;
            if ($bind) {
                $bindings[] = $this->bindable($value);
            }
        }

        $this->reset();

        if (! $columns) {
            return false;
        }

        return $this->runWrite('INSERT INTO '.$this->protectTable($table).' ('.implode(', ', $columns).') VALUES ('.implode(', ', $placeholders).')', $bindings);
    }

    public function insert_batch($table, $rows = null, $escape = null, $batchSize = 100)
    {
        if (! $rows) {
            return false;
        }

        $inserted = 0;

        foreach (array_chunk($rows, $batchSize) as $chunk) {
            $columns = array_keys((array) $chunk[0]);
            $row = '('.implode(', ', array_fill(0, count($columns), '?')).')';
            $bindings = [];

            foreach ($chunk as $item) {
                foreach ($columns as $column) {
                    $bindings[] = $this->bindable(((array) $item)[$column] ?? null);
                }
            }

            $sql = 'INSERT INTO '.$this->protectTable($table).' ('.implode(', ', array_map([$this, 'protect'], $columns)).') VALUES '.implode(', ', array_fill(0, count($chunk), $row));

            if ($this->runWrite($sql, $bindings)) {
                $inserted += $this->affectedRows;
            }
        }

        return $inserted;
    }

    public function update($table = '', $set = null, $where = null, $limit = null)
    {
        if ($set !== null) {
            $this->set($set);
        }
        if ($where !== null) {
            $this->where($where);
        }
        if ($limit !== null) {
            $this->limit($limit);
        }

        if (! $this->set) {
            $this->reset();

            return false;
        }

        $assignments = $bindings = [];

        foreach ($this->set as $column => [$value, $bind]) {
            $assignments[] = $this->protect($column).' = '.($bind ? '?' : $value);
            if ($bind) {
                $bindings[] = $this->bindable($value);
            }
        }

        $sql = 'UPDATE '.$this->protectTable($table).' SET '.implode(', ', $assignments).$this->compileWhere().$this->compileLimit();
        $bindings = array_merge($bindings, $this->whereBindings);
        $this->reset();

        return $this->runWrite($sql, $bindings);
    }

    public function delete($table = '', $where = '', $limit = null, $resetData = true)
    {
        if ($where !== '') {
            $this->where($where);
        }
        if ($limit !== null) {
            $this->limit($limit);
        }

        // CI refuses a DELETE without WHERE; empty_table() is the explicit way to do that.
        if (! $this->where) {
            $this->reset();

            return false;
        }

        $sql = 'DELETE FROM '.$this->protectTable($table).$this->compileWhere().$this->compileLimit();
        $bindings = $this->whereBindings;
        $this->reset();

        return $this->runWrite($sql, $bindings);
    }

    public function empty_table($table = '')
    {
        return $this->runWrite('DELETE FROM '.$this->protectTable($table), []);
    }

    public function truncate($table = '')
    {
        return $this->runWrite('TRUNCATE '.$this->protectTable($table), []);
    }

    public function query($sql, $binds = false, $returnObject = null)
    {
        $bindings = $binds === false ? [] : array_map([$this, 'bindable'], array_values((array) $binds));

        if (preg_match('/^\s*"?(SET|INSERT|UPDATE|DELETE|REPLACE|CREATE|DROP|TRUNCATE|LOAD|COPY|ALTER|RENAME|GRANT|REVOKE|LOCK|UNLOCK|REINDEX|MERGE)\s/i', $sql)) {
            return $this->runWrite($sql, $bindings);
        }

        return $this->runSelect($sql, $bindings);
    }

    public function simple_query($sql)
    {
        return $this->query($sql);
    }

    public function insert_id()
    {
        return (int) DB::getPdo()->lastInsertId();
    }

    public function affected_rows()
    {
        return $this->affectedRows;
    }

    public function last_query()
    {
        return $this->lastQuery;
    }

    public function error()
    {
        return $this->lastError;
    }

    public function escape($value)
    {
        if (is_bool($value)) {
            return (int) $value;
        }
        if ($value === null) {
            return 'NULL';
        }

        return is_string($value) ? DB::getPdo()->quote($value) : $value;
    }

    public function escape_str($value, $like = false)
    {
        $quoted = substr(DB::getPdo()->quote((string) $value), 1, -1);

        return $like ? str_replace(['!', '%', '_'], ['!!', '!%', '!_'], $quoted) : $quoted;
    }

    public function escape_like_str($value)
    {
        return $this->escape_str($value, true);
    }

    public function list_tables()
    {
        return array_map(fn ($row) => array_values((array) $row)[0], DB::select('SHOW TABLES'));
    }

    public function table_exists($table)
    {
        return in_array($table, $this->list_tables(), true);
    }

    public function list_fields($table)
    {
        return array_map(fn ($row) => $row->Field, DB::select('SHOW COLUMNS FROM '.$this->protectTable($table)));
    }

    public function field_exists($field, $table)
    {
        return in_array($field, $this->list_fields($table), true);
    }

    public function trans_start($testMode = false)
    {
        DB::beginTransaction();

        return true;
    }

    public function trans_complete()
    {
        DB::commit();

        return true;
    }

    public function trans_status()
    {
        return true;
    }

    private function compileSelect(): array
    {
        $sql = ($this->distinct ? 'SELECT DISTINCT ' : 'SELECT ').($this->select ? implode(', ', $this->select) : '*');

        if ($this->from) {
            $sql .= "\nFROM ".implode(', ', $this->from);
        }
        if ($this->joins) {
            $sql .= "\n".implode("\n", $this->joins);
        }

        $sql .= $this->compileWhere();

        if ($this->groupBy) {
            $sql .= "\nGROUP BY ".implode(', ', $this->groupBy);
        }
        if ($this->having) {
            $sql .= "\nHAVING ".implode("\n", $this->having);
        }
        if ($this->orderBy) {
            $sql .= "\nORDER BY ".implode(', ', $this->orderBy);
        }

        $sql .= $this->compileLimit();

        return [$sql, array_merge($this->whereBindings, $this->havingBindings)];
    }

    private function compileWhere(): string
    {
        return $this->where ? "\nWHERE ".implode("\n", $this->where) : '';
    }

    private function compileLimit(): string
    {
        if ($this->limit === null && $this->offset === null) {
            return '';
        }

        return "\nLIMIT ".($this->offset ? $this->offset.', ' : '').(int) $this->limit;
    }

    private function reset(): void
    {
        $this->select = $this->from = $this->joins = $this->where = $this->whereBindings = [];
        $this->groupBy = $this->having = $this->havingBindings = $this->orderBy = $this->set = [];
        $this->distinct = false;
        $this->limit = $this->offset = null;
    }

    /**
     * Ported from CI_DB_query_builder::_wh().
     */
    private function condition($key, $value, $escape, array &$bindings): string
    {
        $key = (string) $key;

        if ($value !== null) {
            if ($escape === false) {
                $suffix = ' '.$value;
            } else {
                $suffix = ' ?';
                $bindings[] = $this->bindable($value);
            }

            if (! $this->hasOperator($key)) {
                $key .= ' =';
            }

            return $this->protectConditionKey($key, $escape).$suffix;
        }

        if (! $this->hasOperator($key)) {
            return $this->protectConditionKey($key, $escape).' IS NULL';
        }

        if (preg_match('/\s*(!?=|<>|\sIS(?:\s+NOT)?\s)\s*$/i', $key, $match, PREG_OFFSET_CAPTURE)) {
            $column = substr($key, 0, $match[0][1]);

            return $this->protect($column).($match[1][0] === '=' ? ' IS NULL' : ' IS NOT NULL');
        }

        return $key;
    }

    private function hasOperator(string $key): bool
    {
        return (bool) preg_match('/(<|>|!|=|\sIS NULL|\sIS NOT NULL|\sEXISTS\s*\(.*\)|\sBETWEEN|\sLIKE|\sIN\s*\(|\s)/i', trim($key));
    }

    private function protectConditionKey(string $key, $escape): string
    {
        if ($escape === false) {
            return $key;
        }

        if (preg_match('/^\s*([\w.]+)\s*(<=|>=|<>|!=|=|<|>|NOT LIKE|LIKE|IS NOT|IS)?\s*$/i', $key, $match)) {
            return $this->protect($match[1]).(isset($match[2]) && $match[2] !== '' ? ' '.$match[2] : '');
        }

        return $key;
    }

    /**
     * Quotes "col" or "alias.col" so reserved words work as column names, as CI did.
     * Anything more complex (functions, literals) is left untouched.
     */
    private function protect(string $identifier): string
    {
        $identifier = trim($identifier);

        if (! preg_match('/^[A-Za-z_]\w*(\.[A-Za-z_]\w*|\.\*)?$/', $identifier)) {
            return $identifier;
        }

        return implode('.', array_map(fn ($part) => $part === '*' ? '*' : '`'.$part.'`', explode('.', $identifier)));
    }

    private function protectList(string $list): string
    {
        if (str_contains($list, '(') || str_contains($list, '`') || str_contains($list, "'")) {
            return $list;
        }

        $items = [];

        foreach (explode(',', $list) as $item) {
            $item = trim($item);

            if (preg_match('/^(\S+)\s+(?:AS\s+)?(\w+)$/i', $item, $match)) {
                $items[] = $this->protect($match[1]).' AS `'.$match[2].'`';
            } else {
                $items[] = $this->protect($item);
            }
        }

        return implode(', ', $items);
    }

    private function protectTable(string $table): string
    {
        if (preg_match('/^(\w+)(?:\s+(?:AS\s+)?(\w+))?$/i', $table, $match)) {
            return '`'.$match[1].'`'.(isset($match[2]) ? ' AS `'.$match[2].'`' : '');
        }

        return $table;
    }

    private function protectQualified(string $condition): string
    {
        $parts = preg_split('/(\'[^\']*\'|"[^"]*"|`[^`]*`)/', $condition, -1, PREG_SPLIT_DELIM_CAPTURE);

        foreach ($parts as $i => $part) {
            if ($i % 2 === 0) {
                $parts[$i] = preg_replace('/(?<![\w.`])([A-Za-z_]\w*)\.([A-Za-z_]\w*)(?![\w`(])/', '`$1`.`$2`', $part);
            }
        }

        return implode('', $parts);
    }

    private function bindable($value)
    {
        if (is_bool($value)) {
            return (int) $value;
        }

        return is_array($value) ? 'Array' : $value;
    }

    private function runSelect(string $sql, array $bindings)
    {
        $this->lastQuery = $this->interpolate($sql, $bindings);

        try {
            return new Result(DB::select($sql, $bindings));
        } catch (Throwable $e) {
            return $this->failed($e);
        }
    }

    private function runWrite(string $sql, array $bindings)
    {
        $this->lastQuery = $this->interpolate($sql, $bindings);

        try {
            $this->affectedRows = DB::affectingStatement($sql, $bindings);

            return true;
        } catch (Throwable $e) {
            return $this->failed($e);
        }
    }

    private function failed(Throwable $e): bool
    {
        $this->lastError = ['code' => $e->getCode(), 'message' => $e->getMessage()];
        $this->affectedRows = 0;
        log_message('error', $e->getMessage());

        return false;
    }

    private function interpolate(string $sql, array $bindings): string
    {
        foreach ($bindings as $binding) {
            $sql = preg_replace('/\?/', str_replace(['\\', '$'], ['\\\\', '\\$'], (string) $this->escape($binding)), $sql, 1);
        }

        return $sql;
    }
}
