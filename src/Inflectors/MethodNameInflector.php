<?php

namespace Madewithlove\LaravelCqrsEs\Inflectors;

interface MethodNameInflector
{
    /**
     * @param $event
     * @return string
     */
    public function inflect($event);
}