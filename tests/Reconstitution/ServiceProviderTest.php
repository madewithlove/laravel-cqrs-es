<?php

namespace Madewithlove\LaravelCqrsEs\Tests\Reconstitution;

use BroadwaySerialization\Reconstitution\ReconstituteUsingInstantiatorAndHydrator;
use BroadwaySerialization\Reconstitution\Reconstitution;
use Madewithlove\LaravelCqrsEs\Tests\TestCase;

class ServiceProviderTest extends TestCase
{
    /**
     * @test
     */
    public function itSetsUpReconstitution()
    {
        self::assertInstanceOf(ReconstituteUsingInstantiatorAndHydrator::class, Reconstitution::reconstitute());
    }
}