<?php

namespace Madewithlove\LaravelCqrsEs\ReadModel\Contracts;

use Broadway\EventHandling\EventListener;
use Broadway\ReadModel\ProjectorInterface;
use Madewithlove\LaravelCqrsEs\Inflectors\MethodNameInflector;

interface Projector extends EventListener
{
    /**
     * @param MethodNameInflector $inflector
     *
     * @return Projector
     */
    public function setInflector(MethodNameInflector $inflector);
}