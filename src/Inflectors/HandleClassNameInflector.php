<?php

namespace Madewithlove\LaravelCqrsEs\Inflectors;

class HandleClassNameInflector implements MethodNameInflector
{
    /**
     * @param $event
     * @return string
     */
    public function inflect($event)
    {
        $classParts = explode('\\', get_class($event));
        return 'handle' . end($classParts);
    }
}