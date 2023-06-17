<?php

namespace Danieletulone\LaravelToolkit\Traits\Enum;

use Illuminate\Support\Str;

/**
 * Trait Labelable.
 * This trait allows to convert an enum to a label.
 * The label is the value of the enum, translated.
 *
 * The translation is in resources/lang/en/enum.php.
 * The translation is in the form:
 *
 * ```php
 * <?php
 *
 * return [
 *    'App\Enums\ExampleEnum' => [
 *       'SUSPENDED' => 'Suspended',
 *       'ACTIVE' => 'Active',
 *    ],
 * ];
 * ```
 */
trait LabelableEnum
{
    /**
     * Convert the enum to an array of labels.
     * The key is the value of the enum, the value is the label.
     */
    public static function toLabels(): array
    {
        $cases = self::cases();
        $labels = [];

        foreach ($cases as $case) {
            $labels[$case->value] = $case->toLabel();
        }

        return $labels;
    }

    /**
     * Convert the enum to a label.
     * The label is the value of the enum, translated.
     */
    public function toLabel($locale = null): string
    {
        return __('enum.' . self::class . '.' . $this->toKey(), [], $locale);
    }

    public function toKey()
    {
        return Str::snake(Str::lower($this->name));
    }
}
