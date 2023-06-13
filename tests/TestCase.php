<?php

namespace Danieletulone\LaravelToolkit\Tests;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return ['Danieletulone\LaravelToolkit\LaravelToolkitServiceProvider'];
    }

    protected function defineRoutes($router)
    {
        //
    }
}