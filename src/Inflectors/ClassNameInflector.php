<?php

namespace Madewithlove\LaravelCqrsEs\Inflectors;

abstract class ClassNameInflector implements MethodNameInflector
{
    /**
     * @var string
     */
    protected $prefix = 'handle';

    /**
     * @param $event
     *
     * @return string
     */
    public function inflect($event)
    {
        $classParts = explode('\\', get_class($event));

        return $this->prefix.end($classParts);
    }
}