<?php

namespace Madewithlove\LaravelCqrsEs\Inflectors;

class HandleClassNameInflector extends ClassNameInflector
{
    /**
     * @var string
     */
    protected $prefix = 'handle';
}