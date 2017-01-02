<?php

namespace Madewithlove\LaravelCqrsEs\Generators\Console;

use Illuminate\Config\Repository;
use Illuminate\Console\AppNamespaceDetectorTrait;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Illuminate\Support\Fluent;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

abstract class AbstractGeneratorCommand extends GeneratorCommand
{
    use AppNamespaceDetectorTrait;

    /**
     * @var Composer
     */
    protected $composer;

    /**
     * @var Repository
     */
    protected $config;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var Fluent
     */
    protected $settings;

    /**
     * @param Filesystem $files
     * @param Composer $composer
     * @param Repository $config
     */
    public function __construct(Filesystem $files, Composer $composer, Repository $config)
    {
        parent::__construct($files);

        $this->config = $config;
        $this->composer = $composer;
        $this->settings = new Fluent([
            'paths' => $config->get('broadway.generators.paths'),
        ]);
    }

    /**
     * @return bool
     */
    public function fire()
    {
        $this->settings->type = $this->option('type');
        $this->settings->isTest = Str::contains($this->settings->type, 'Test');

        parent::fire();
    }

    /**
     * Get the destination class path.
     *
     * @param  string $name
     *
     * @return string
     */
    protected function getPath($name)
    {
        $name = str_replace($this->laravel->getNamespace(), '', $name);
        $directory = $this->laravel['path'];

        if ($this->settings->isTest) {
            $name = str_replace('Test', '', $name);
            $name .= 'Test';
            $directory = $this->settings->paths['tests'];
        }

        return $directory.'/'.str_replace('\\', '/', $name).'.php';
    }

    /**
     * @param string $name
     *
     * @return string
     */
    protected function parseName($name)
    {
        return $this->getNamespaceForType($this->settings->type).'\\'.$name;
    }

    /**
     * @param string $name
     *
     * @return string
     */
    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());
        $type = $this->settings->type;

        $aggregate = $this->option('aggregate');

        $replacements = [
            'rootNamespace' => $this->getAppNamespace(),
            'namespace' => $this->getNamespaceForType($type),
            'class' => $this->getNameInput(),
            'aggregate' => ucfirst($this->getAggregateName()),
            'aggregateUpper' => ucfirst($aggregate),
            'aggregateClass' => $this->getNamespaceForType('aggregates').'\\'.ucfirst($aggregate),
        ];

        switch ($type) {
            case 'commandHandler':
                $replacements['command'] = $this->getNamespaceForType('command').'\\'.$this->getNameInput();
                break;
            case 'commandHandlerTest':
                $replacements['commandHandler'] = $this->getNamespaceForType('commandHandler').'\\'.$this->getNameInput();
                $replacements['command'] = $this->getNamespaceForType('command').'\\'.$this->getNameInput();
                break;
        }

        foreach ($replacements as $placeholder => $replacement) {
            $stub = str_replace('{{'.$placeholder.'}}', $replacement, $stub);
        }

        return $stub;
    }

    /**
     * @return mixed
     */
    protected function getStub()
    {
        $stubsFolder = $this->config->get('broadway.generators.paths.stubs');

        return $stubsFolder.'/'.$this->settings->type.'.stub';
    }

    /**
     * @return string
     */
    protected function getAggregateName()
    {
        return str_plural($this->option('aggregate'));
    }

    /**
     * @param $type
     *
     * @return string
     */
    protected function getNamespaceForType($type)
    {
        if (Str::contains($type, 'Repository')) {
            $type = 'repository';
        }

        if (Str::contains($type, 'serviceProvider')) {
            $type = '';
        }

        $type = ucfirst(str_plural($type));
        $rootNamespace = $this->getAppNamespace();
        $aggregateName = ucfirst($this->getAggregateName());

        return rtrim($rootNamespace.implode('\\', [$aggregateName, $type]), '\\');
    }

    /**
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['aggregate', null, InputOption::VALUE_REQUIRED, 'The aggregate the class belongs to'],
            ['type', null, InputOption::VALUE_OPTIONAL, 'The type of class to generate', $this->type],
        ];
    }


    /**
     * @param $type
     * @param array $options
     *
     * @internal param $name
     */
    protected function callCommandFile($type, $options = [])
    {
        $this->call('make:cqrs:file', array_merge([
            'name' => $this->getNameInput(),
            '--type' => $type,
            '--aggregate' => $this->option('aggregate'),
        ], $options));
    }
}