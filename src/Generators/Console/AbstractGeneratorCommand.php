<?php

namespace Madewithlove\LaravelCqrsEs\Generators\Console;

use Illuminate\Config\Repository;
use Illuminate\Console\AppNamespaceDetectorTrait;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Illuminate\Support\Fluent;
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
        $this->settings = new Fluent();
    }

    /**
     * @return bool
     */
    public function fire()
    {
        $this->settings->type = $this->option('type');

        parent::fire();
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

        $replacements = [
            '{{namespace}}' => $this->getNamespaceForType($type),
            '{{class}}' => $this->getNameInput(),
        ];

        switch ($type) {
            case 'commandHandler':
                $replacements['{{command}}'] = $this->getNamespaceForType('command').'\\'.$this->getNameInput();
                break;
        }

        foreach ($replacements as $placeholder => $replacement) {
            $stub = str_replace($placeholder, $replacement, $stub);
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
        $type = ucfirst(str_plural($type));
        $rootNamespace = $this->getAppNamespace();
        $aggregateName = $this->getAggregateName();

        return $rootNamespace . implode('\\', [$aggregateName, $type]);
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
     * @param $name
     * @param array $options
     */
    protected function callCommandFile($type, $name = null, $options = [])
    {
        $this->call('generate:file', array_merge($options, [
            'name'    => $name ?: $this->getNameInput(),
            '--type'  => $type,
            '--aggregate' => $this->option('aggregate'),
        ]));
    }
}