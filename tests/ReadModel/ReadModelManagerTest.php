<?php

namespace Madewithlove\LaravelCqrsEs\Tests\ReadModel;

use Elasticsearch\Client;
use Madewithlove\LaravelCqrsEs\ReadModel\ReadModelManager;
use Madewithlove\LaravelCqrsEs\Tests\TestCase;

class ReadModelManagerTest extends TestCase
{
    /**
     * @test
     */
    public function itCanGetDefaultDriver()
    {
        $manager = new ReadModelManager($this->app);

        self::assertEquals('elasticsearch', $manager->getDefaultDriver());
    }

    /**
     * @test
     */
    public function itCanCreateElasticsearchDriver()
    {
        $manager = new ReadModelManager($this->app);

        $driver = $manager->createElasticsearchDriver();
        self::assertInstanceOf(Client::class, $driver);
    }
}
