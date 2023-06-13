<?php

namespace Danieletulone\LaravelToolkit\Tests\Feature\Traits\Enum;

use Danieletulone\LaravelToolkit\Tests\TestCase;
use Danieletulone\LaravelToolkit\Traits\Enum\LabelableEnum;

enum ExampleEnum:int
{
    use LabelableEnum;

    case FIRST = 0;
    case SECOND = 1;
    case WITH_SPACE = 2;
}

class LabelableEnumTest extends TestCase
{
    public function testToLabel()
    {
        $this->assertEquals(
            'enum.'.ExampleEnum::class. '.0',
            ExampleEnum::FIRST->toLabel()
        );
    }

    public function testToDotKey()
    {
        $this->assertEquals(
            'first',
            ExampleEnum::FIRST->toKey()
        );
        
        $this->assertEquals(
            'with_space',
            ExampleEnum::WITH_SPACE->toKey()
        );
    }
}