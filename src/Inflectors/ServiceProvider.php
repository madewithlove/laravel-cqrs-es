<?php

namespace Madewithlove\LaravelCqrsEs\Inflectors;

use Madewithlove\LaravelCqrsEs\ProcessManager\Contracts\ProcessManager;
use Madewithlove\LaravelCqrsEs\ReadModel\Contracts\Projector;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        $this->app->resolving(ProcessManager::class, function (ProcessManager $manager) {
            return $manager->setInflector(new ProcessClassNameInflector());
        });

        $this->app->resolving(Projector::class, function (Projector $manager) {
            return $manager->setInflector(new ProjectClassNameInflector());
        });
    }
}