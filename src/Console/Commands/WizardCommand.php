<?php

namespace Danieletulone\LaravelToolkit\Console\Commands;

use Illuminate\Console\Command;

class WizardCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel-toolkit:wizard';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start the wizard for laravel-toolkit';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->confirm('Do you want to init laravel-notification-channels/fcm?')) {
            $this->info('You should add FIREBASE_CREDENTIALS to your .env file');
        }
    }
}
