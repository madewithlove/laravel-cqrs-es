<?php

namespace Madewithlove\LaravelCqrsEs\Inflectors;

class ProcessClassNameInflector implements MethodNameInflector
{
    /**
     * @param $event
     * @return string
     */
    public function inflect($event)
    {
        $classParts = explode('\\', get_class($event));
        return 'process' . end($classParts);
    }
}