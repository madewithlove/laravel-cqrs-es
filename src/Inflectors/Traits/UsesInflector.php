<?php

namespace Madewithlove\LaravelCqrsEs\Inflectors\Traits;

use Madewithlove\LaravelCqrsEs\Inflectors\MethodNameInflector;

trait UsesInflector
{
    /**
     * @var MethodNameInflector
     */
    private $methodNameInflector;

    /**
     * @param MethodNameInflector $inflector
     *
     * @return UsesInflector
     */
    public function setInflector(MethodNameInflector $inflector)
    {
        $this->methodNameInflector = $inflector;

        return $this;
    }
}