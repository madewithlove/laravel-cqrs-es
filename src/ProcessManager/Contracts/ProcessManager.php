<?php

namespace Madewithlove\LaravelCqrsEs\ProcessManager\Contracts;

use Broadway\EventHandling\EventListener;
use Madewithlove\LaravelCqrsEs\Inflectors\MethodNameInflector;

interface ProcessManager extends EventListener
{
    /**
     * @param MethodNameInflector $inflector
     *
     * @return ProcessManager
     */
    public function setInflector(MethodNameInflector $inflector);
}