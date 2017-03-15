<?php

namespace Madewithlove\LaravelCqrsEs\Tests\ReadModel;

use Broadway\Domain\DomainMessage;
use Broadway\Domain\Metadata;
use Madewithlove\LaravelCqrsEs\ReadModel\Projector;
use Madewithlove\LaravelCqrsEs\Tests\Stubs\BookWasPurchased;
use Madewithlove\LaravelCqrsEs\Tests\Stubs\BookWasReturned;
use Madewithlove\LaravelCqrsEs\Tests\TestCase;

class BooksProjector extends Projector
{
    private $projected = false;

    /**
     * @return boolean
     */
    public function isProjected()
    {
        return $this->projected;
    }


    protected function projectBookWasPurchased()
    {
        $this->projected = true;
    }
}

class ProjectorTest extends TestCase
{
    public function testItCanProjectADomainMessage()
    {
        $projector = $this->app->make(BooksProjector::class);

        $message = DomainMessage::recordNow('1', 1, new Metadata(), new BookWasPurchased());
        $projector->handle($message);

        self::assertTrue($projector->isProjected());
    }

    public function testItCannotProjectADomainMessage()
    {
        $projector = $this->app->make(BooksProjector::class);

        $message = DomainMessage::recordNow('1', 1, new Metadata(), new BookWasReturned());
        $projector->handle($message);

        self::assertFalse($projector->isProjected());
    }
}
