<?php

namespace Madewithlove\LaravelCqrsEs\Tests\Serializers;

use Broadway\Serializer\SerializerInterface;
use Broadway\Serializer\SimpleInterfaceSerializer;
use Madewithlove\LaravelCqrsEs\Tests\TestCase;

class ServiceProviderTest extends TestCase
{
    /**
     * @test
     */
    public function itBindsInterfaces()
    {
        self::assertInstanceOf(SimpleInterfaceSerializer::class, $this->app->make(SerializerInterface::class));
    }
}