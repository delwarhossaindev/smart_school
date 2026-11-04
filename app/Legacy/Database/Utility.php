<?php

namespace App\Legacy\Database;

use Illuminate\Support\Facades\DB;
use ZipArchive;

class Utility
{
    public function backup(array $params = [])
    {
        $sql = '';
        $pdo = DB::getPdo();

        foreach (DB::select('SHOW TABLES') as $row) {
            $table = array_values((array) $row)[0];
            $create = (array) DB::select("SHOW CREATE TABLE `{$table}`")[0];

            $sql .= "DROP TABLE IF EXISTS `{$table}`;\n".$create['Create Table'].";\n\n";

            foreach (DB::select("SELECT * FROM `{$table}`") as $record) {
                $values = array_map(fn ($v) => $v === null ? 'NULL' : $pdo->quote($v), (array) $record);
                $sql .= "INSERT INTO `{$table}` VALUES (".implode(',', $values).");\n";
            }

            $sql .= "\n";
        }

        if (($params['format'] ?? '') !== 'zip') {
            return $sql;
        }

        $file = tempnam(sys_get_temp_dir(), 'bak');
        $zip = new ZipArchive();
        $zip->open($file, ZipArchive::OVERWRITE);
        $zip->addFromString($params['filename'] ?? 'backup.sql', $sql);
        $zip->close();

        $contents = file_get_contents($file);
        unlink($file);

        return $contents;
    }
}
