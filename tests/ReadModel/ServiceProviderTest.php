<?php

namespace Madewithlove\LaravelCqrsEs\Tests\ReadModel;

use Madewithlove\LaravelCqrsEs\ReadModel\ReadModelManager;
use Madewithlove\LaravelCqrsEs\Tests\TestCase;

class ServiceProviderTest extends TestCase
{
    /**
     * @test
     */
    public function itRegistersServices()
    {
        self::assertInstanceOf(ReadModelManager::class, $this->app->make('read_model.manager'));
        self::assertInstanceOf(ReadModelManager::class, $this->app->make(ReadModelManager::class));
        self::assertEquals($this->app->make('read_model.manager'), $this->app->make(ReadModelManager::class));
    }
}