<?php

namespace Danieletulone\LaravelToolkit;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Danieletulone\LaravelToolkit\Skeleton\SkeletonClass
 */
class LaravelToolkitFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'toolkit';
    }
}
