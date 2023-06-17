<?php

namespace Danieletulone\LaravelToolkit\Helpers;

class TranslatableColumnConverter
{
    public static function apply($model, $column)
    {
        $model::all()->each(function ($model) use ($column) {
            $model->{$column} = json_encode([
                'en' => $model->{$column},
            ]);

            $model->save();
        });
    }

    public static function revert($model, $column)
    {
        $model::all()->each(function ($model) use ($column) {
            $model->{$column} = json_decode($model->getRawOriginal($column))->en;

            $model->save();
        });
    }
}
