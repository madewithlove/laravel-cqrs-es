<?php

namespace Madewithlove\LaravelCqrsEs\Generators\Console;

class Aggregate extends AbstractGeneratorCommand
{
    /**
     * @var string
     */
    protected $name = 'make:cqrs:aggregate';

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
        $this->callCommandFile('writeRepository', ['--aggregate' => $this->getNameInput(), 'name' => 'WriteRepository']);
        $this->callCommandFile('dbalWriteRepository', ['--aggregate' => $this->getNameInput(), 'name' => 'DbalWriteRepository']);
        $this->callCommandFile('serviceProvider', ['--aggregate' => $this->getNameInput(), 'name' => 'ServiceProvider']);

        $this->info('Do not forget to add the service provider to your loaded providers in app.php!');
        $this->info('All Done!');
    }
}