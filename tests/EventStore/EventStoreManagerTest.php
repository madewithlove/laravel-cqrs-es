<?php

namespace Madewithlove\LaravelCqrsEs\Tests\ReadModel;

use Elasticsearch\Client;
use Madewithlove\LaravelCqrsEs\EventStore\EventStoreManager;
use Madewithlove\LaravelCqrsEs\ReadModel\ReadModelManager;
use Madewithlove\LaravelCqrsEs\Tests\TestCase;

class EventStoreManagerTest extends TestCase
{
    /**
     * @test
     */
    public function itCanGetDefaultDriver()
    {
        $manager = new EventStoreManager($this->app);

        self::assertEquals('dbal', $manager->getDefaultDriver());
    }
}
