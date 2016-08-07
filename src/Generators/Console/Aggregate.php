<?php

namespace Madewithlove\LaravelCqrsEs\Generators\Console;

class Aggregate extends AbstractGeneratorCommand
{
    /**
     * @var string
     */
    protected $name = 'generate:aggregate';

    /**
     * @var string
     */
    protected $description = 'Generate aggregateRoot and associated write repository';

    /**
     * @var string
     */
    protected $type = 'aggregate';

    /**
     *
     */
    public function fire()
    {
        $this->callCommandFile('aggregate', ['--aggregate' => $this->getNameInput()]);

        $this->info('All Done!');
    }
}