<?php

namespace App\Classes;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class TableCloner
{
    public static function clone(string $table)
    {
        if (!Schema::hasTable($table)) {
            throw new \Exception("Table $table does not exists");
        }

        $newTable = $table . '_backup';

        if (Schema::hasTable($newTable)) {
            DB::statement("DROP TABLE $newTable");
        }

        DB::statement("CREATE TABLE $newTable LIKE $table");
        DB::statement("INSERT $newTable SELECT * FROM $table");
    }

    public function isTableExists(string $table)
    {
        return Schema::hasTable($table);
    }

    public static function deleteClone(string $table)
    {
        $newTable = $table . '_backup';

        if (Schema::hasTable($newTable)) {
            DB::statement("DROP TABLE $newTable");
        }
    }
}
