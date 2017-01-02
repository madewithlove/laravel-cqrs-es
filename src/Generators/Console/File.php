<?php

namespace Madewithlove\LaravelCqrsEs\Generators\Console;

class File extends AbstractGeneratorCommand
{
    /**
     * @var string
     */
    protected $name = 'make:cqrs:file';

    /**
     * @var string
     */
    protected $description = 'Generate a new file using a stub';

    /**
     * @var string
     */
    protected $type = 'file';
}