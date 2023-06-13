<?php

namespace Danieletulone\LaravelToolkit\Listeners;

use Illuminate\Support\Facades\DB;

/**
 * This event listener is used to disable the requirement
 * for tables in the database to have a primary key defined.
 * Required by DigitalOcean to work correctly.
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
