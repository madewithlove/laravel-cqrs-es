<?php

namespace Madewithlove\LaravelCqrsEs\Tests\Inflectors;

use Madewithlove\LaravelCqrsEs\Inflectors\HandleClassNameInflector;
use Madewithlove\LaravelCqrsEs\Tests\Stubs\BookWasPurchased;
use Madewithlove\LaravelCqrsEs\Tests\TestCase;

class HandleClassNameInflectorTest extends TestCase
{
    /**
     * @test
     */
    public function itCanInflectAClassName()
    {
        $inflector = new HandleClassNameInflector();

        self::assertEquals('handleBookWasPurchased', $inflector->inflect(new BookWasPurchased()));
    }
}
