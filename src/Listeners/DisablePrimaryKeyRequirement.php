<?php

namespace Danieletulone\LaravelToolkit\Listeners;

use Illuminate\Support\Facades\DB;

/**
 * This event listener is used to disable the primary key requirement on migrations.
 * 
 * The SQL statement SET SESSION sql_require_primary_key=0 is used to disable the requirement
 * for a primary key in certain database management systems (DBMS), particularly in cloud databases.
 * By default, many relational database systems enforce the presence of a primary key on each table
 * as a means of ensuring data integrity and facilitating efficient indexing.
 *
 * However, there may be scenarios where you might want to disable this requirement temporarily or permanently.
 *
 *1. Add the use:
 *
 * ```php
 * use App\Listeners\DisablePrimaryKeyRequirement;
 * use Illuminate\Database\Events\MigrationStarted;
 * ```
 * 
 * 2. Add this lines in `$listen` array:
 * 
 * ```php
 * MigrationStarted::class => [
 *     DisablePrimaryKeyRequirement::class,
 * ]
 * ```
 */
class DisablePrimaryKeyRequirement
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if (app()->environment('production')) {
            DB::statement('SET SESSION sql_require_primary_key=0');
        }
    }
}
