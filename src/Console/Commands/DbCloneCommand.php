<?php

namespace App\Console\Commands;

use App\Classes\TableCloner;
use Illuminate\Console\Command;

class DbCloneCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:clone {table} {--delete}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a {$table}_backup table and copy all data from {$table} to {$table}_backup. If --delete option is passed, it will delete the backup table.';

    /**
     * Execute the console command.
     *
     * TODO add check for table existence
     * @return int
     */
    public function handle()
    {
        if ($this->option('delete')) {
            TableCloner::deleteClone($this->argument('table'));
            return Command::SUCCESS;
        }

        TableCloner::clone($this->argument('table'));
        return Command::SUCCESS;
    }
}
