<?php

namespace Madewithlove\LaravelCqrsEs\Generators\Console;

class Command extends AbstractGeneratorCommand
{
    /**
     * @var string
     */
    protected $name = 'make:cqrs:command';

    /**
     * @var string
     */
    protected $description = 'Generate new command, command handler and command handler test case';

    /**
     * @var string
     */
    protected $type = 'command';

    /**
     *
     */
    public function fire()
    {
        $this->callCommand();
        $this->callCommandHandler();
        $this->callCommandHandlerTest();

        $this->info('All Done!');
    }

    /**
     *
     */
    private function callCommand()
    {
        $this->callCommandFile('command');
    }

    /**
     *
     */
    private function callCommandHandler()
    {
        $this->callCommandFile('commandHandler');
    }

    /**
     *
     */
    private function callCommandHandlerTest()
    {
        $this->callCommandFile('commandHandlerTest');
    }
}