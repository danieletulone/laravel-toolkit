<?php

namespace Danieletulone\LaravelToolkit\Traits\Nova;

trait TranslatableResource
{
    public static function __(
        string $name,
        $resource = null,
        $replace = [],
        $locale = null
    ) {
        if (is_null($resource)) {
            $resource = static::class;
        }

        $key = 'nova.' . $resource . '.' . $name;
        $translation = __($key, $replace, $locale);

        if ($key == $translation) {
            $fallbackKey = 'nova.shared.' . $name;
            $fallbackTrans = __($fallbackKey);

            if ($fallbackKey != $fallbackTrans) {
                return $fallbackTrans;
            }
        }

        return $translation;
    }

    public static function label()
    {
        return self::__('label');
    }

    public static function singularLabel()
    {
        return self::__('singular_label');
    }
}
