<?php

namespace Madewithlove\LaravelCqrsEs\ReadModel\Contracts;

use Broadway\ReadModel\ProjectorInterface;
use Madewithlove\LaravelCqrsEs\Inflectors\MethodNameInflector;

interface Projector extends ProjectorInterface
{
    /**
     * @param MethodNameInflector $inflector
     *
     * @return Projector
     */
    public function setInflector(MethodNameInflector $inflector);
}