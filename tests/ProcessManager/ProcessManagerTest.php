<?php

namespace Madewithlove\LaravelCqrsEs\Tests\ReadModel;

use Broadway\Domain\DomainMessage;
use Broadway\Domain\Metadata;
use Madewithlove\LaravelCqrsEs\ProcessManager\ProcessManager;
use Madewithlove\LaravelCqrsEs\Tests\Stubs\BookWasPurchased;
use Madewithlove\LaravelCqrsEs\Tests\Stubs\BookWasReturned;
use Madewithlove\LaravelCqrsEs\Tests\TestCase;

class BooksProcessor extends ProcessManager
{
    private $processed = false;

    /**
     * @return boolean
     */
    public function isProcessed()
    {
        return $this->processed;
    }

    protected function processBookWasPurchased()
    {
        $this->processed = true;
    }
}

class ProcessManagerTest extends TestCase
{
    public function testItCanProcessADomainMessage()
    {
        $processor = $this->app->make(BooksProcessor::class);

        $message = DomainMessage::recordNow('1', 1, new Metadata(), new BookWasPurchased());
        $processor->handle($message);

        self::assertTrue($processor->isProcessed());
    }

    public function testItCannotProcessADomainMessage()
    {
        $processor = $this->app->make(BooksProcessor::class);

        $message = DomainMessage::recordNow('1', 1, new Metadata(), new BookWasReturned());
        $processor->handle($message);

        self::assertFalse($processor->isProcessed());
    }
}
