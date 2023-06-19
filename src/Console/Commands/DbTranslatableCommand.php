<?php

namespace Danieletulone\LaravelToolkit\Console\Commands;

use Danieletulone\LaravelToolkit\Helpers\TranslatableColumnConverter;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

class DbTranslatableCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:translatable {model} {column} {--reverse}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prepare data to be used from string to json or reverse';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $model = $this->argument('model');

        if (!$this->isValidModel($model)) {
            return Command::FAILURE;
        }

        $column = $this->argument('column');

        if ($this->option('reverse')) {
            TranslatableColumnConverter::reverse($model, $column);
            return Command::SUCCESS;
        }

        TranslatableColumnConverter::apply($model, $column);
        return Command::SUCCESS;
    }

    public function isValidModel($modelClass)
    {
        $class = class_exists($modelClass);

        if (!$class) {
            $this->error("$modelClass does not exist");
            return false;
        }

        if (!is_subclass_of($modelClass, Model::class)) {
            $this->error("Model $modelClass is not an instance of Model");
            return false;
        }

        return true;
    }
}
