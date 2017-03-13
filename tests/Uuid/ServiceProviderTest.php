<?php

namespace Madewithlove\LaravelCqrsEs\Tests\Uuid;

use Broadway\UuidGenerator\Rfc4122\Version4Generator;
use Broadway\UuidGenerator\UuidGeneratorInterface;
use Madewithlove\LaravelCqrsEs\Tests\TestCase;

class ServiceProviderTest extends TestCase
{
    /**
     * @test
     */
    public function itBindsInterfaces()
    {
        self::assertInstanceOf(Version4Generator::class, $this->app->make(UuidGeneratorInterface::class));
    }
}