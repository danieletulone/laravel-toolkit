<?php

/**
 * Prefix a string with the app prefix.
 */
function prefix($valuesToPrefix, $separator = '-'): string
{
    if ($valuesToPrefix == null) {
        throw new \Exception('The value to prefix cannot be null.');
    }

    if (is_string($valuesToPrefix) || is_numeric($valuesToPrefix)) {
        $valuesToPrefix = [$valuesToPrefix];
    }

    if (is_array($valuesToPrefix)) {
        $valuesToPrefix = array_map(function ($value) {
            return (string) $value;
        }, $valuesToPrefix);
    }

    return implode(
        $separator,
        [config('laravel-toolkit.prefix'), ...$valuesToPrefix]
    );
}
