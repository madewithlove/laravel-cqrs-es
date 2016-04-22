<?php

namespace Madewithlove\LaravelCqrsEs\ReadModel;


class ProjectClassNameInflector implements MethodNameInflector
{
    /**
     * @param $event
     * @return string
     */
    public function inflect($event)
    {
        $classParts = explode('\\', get_class($event));
        return 'project' . end($classParts);
    }
}