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
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
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
