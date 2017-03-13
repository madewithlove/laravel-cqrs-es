<?php

namespace Madewithlove\LaravelCqrsEs\ProcessManager\Contracts;

use Broadway\EventHandling\EventListenerInterface;
use Madewithlove\LaravelCqrsEs\Inflectors\MethodNameInflector;

interface ProcessManager extends EventListenerInterface
{
    /**
     * @param MethodNameInflector $inflector
     *
     * @return ProcessManager
     */
    public function setInflector(MethodNameInflector $inflector);
}