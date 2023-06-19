<?php

namespace Danieletulone\LaravelToolkit\Helpers;

class TranslatableColumnConverter
{
    /**
     * Apply the conversion from string to json
     * 
     * TODO add check for model class
     * TODO add check for column type
     * 
     * @param mixed $model The model class
     * @param mixed $column The column to convert
     * @return void 
     */
    public static function apply($model, $column)
    {
        $model::withoutGlobalScopes()
            ->get()
            ->each(function ($model) use ($column) {
                $model->setRawAttributes([
                    "$column" => [
                        'en' => $model->{$column}
                    ],
                ]);

                $model->save();
            });
    }

    public static function reverse($model, $column)
    {
        $model::withoutGlobalScopes()
            ->get()
            ->each(function ($model) use ($column) {
                $model->setRawAttributes([
                    "$column" => json_decode($model->getRawOriginal($column))->en
                ]);

                $model->save();
            });
    }
}
