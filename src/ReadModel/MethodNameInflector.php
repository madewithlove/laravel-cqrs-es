<?php

namespace Madewithlove\LaravelCqrsEs\ReadModel;

interface MethodNameInflector
{
    /**
     * @param $event
     * @return string
     */
    public function inflect($event);
}