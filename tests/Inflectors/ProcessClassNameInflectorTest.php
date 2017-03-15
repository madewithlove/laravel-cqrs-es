<?php

namespace Madewithlove\LaravelCqrsEs\Tests\Inflectors;

use Madewithlove\LaravelCqrsEs\Inflectors\HandleClassNameInflector;
use Madewithlove\LaravelCqrsEs\Inflectors\ProcessClassNameInflector;
use Madewithlove\LaravelCqrsEs\Tests\Stubs\BookWasPurchased;
use Madewithlove\LaravelCqrsEs\Tests\TestCase;

class ProcessClassNameInflectorTest extends TestCase
{
    /**
     * @test
     */
    public function itCanInflectAClassName()
    {
        $inflector = new ProcessClassNameInflector();

        self::assertEquals('processBookWasPurchased', $inflector->inflect(new BookWasPurchased()));
    }
}
