<?php

namespace Madewithlove\LaravelCqrsEs\Tests\Identifier;

use Broadway\Serializer\SimpleInterfaceSerializer;
use Madewithlove\LaravelCqrsEs\Identifier\Identifier;
use Madewithlove\LaravelCqrsEs\Identifier\UuidIdentifier;
use Madewithlove\LaravelCqrsEs\Tests\TestCase;

class UuidIdentifierTest extends TestCase
{
    const identifier = '6269d39a-0138-43f0-8d4e-0e26d2d90743';

    /**
     * @test
     */
    public function itIsAnInstanceOfIdentifier()
    {
        self::assertInstanceOf(Identifier::class, $this->createIdentifier());
    }

    /**
     * @test
     */
    public function itCanBeConvertedToAString()
    {
        self::assertEquals(static::identifier, $this->createIdentifier()->toString());
        self::assertEquals(static::identifier, (string) $this->createIdentifier());
    }

    /**
     * @test
     */
    public function itCanBeCompared()
    {
        $identifier = $this->createIdentifier();
        $identifierTwo = $this->createIdentifier('22fdd253-ad6c-4255-8dbc-df0766971544');

        self::assertTrue($identifier->equals($identifier));
        self::assertFalse($identifier->equals($identifierTwo));
    }

    /**
     * @test
     */
    public function itCanBeSerialized()
    {
        $identifier = $this->createIdentifier();

        $serializer = new SimpleInterfaceSerializer();

        $serialized   = $serializer->serialize($identifier);
        $deserialized = $serializer->deserialize($serialized);

        $this->assertEquals($identifier, $deserialized);
    }

    /**
     * @param string $id
     *
     * @return UuidIdentifier
     */
    public function createIdentifier($id = self::identifier)
    {
        return UuidIdentifier::fromString($id);
    }
}
