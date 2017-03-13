<?php

namespace Madewithlove\LaravelCqrsEs\Tests\Inflectors;

use Madewithlove\LaravelCqrsEs\Inflectors\HandleClassNameInflector;
use Madewithlove\LaravelCqrsEs\Inflectors\ProjectClassNameInflector;
use Madewithlove\LaravelCqrsEs\Tests\Stubs\BookWasPurchased;
use Madewithlove\LaravelCqrsEs\Tests\TestCase;

class ProjectClassNameInflectorTest extends TestCase
{
    /**
     * @test
     */
    public function itCanInflectAClassName()
    {
        $inflector = new ProjectClassNameInflector();

        self::assertEquals('projectBookWasPurchased', $inflector->inflect(new BookWasPurchased()));
    }
}
