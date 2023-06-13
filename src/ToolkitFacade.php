<?php

namespace Danieletulone\Toolkit;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Danieletulone\Toolkit\Skeleton\SkeletonClass
 */
class ToolkitFacade extends Facade
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
