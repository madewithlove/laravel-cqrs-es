<?php

namespace Madewithlove\LaravelCqrsEs\Generators;

use Madewithlove\LaravelCqrsEs\Generators\Console\Aggregate;
use Madewithlove\LaravelCqrsEs\Generators\Console\Command;
use Madewithlove\LaravelCqrsEs\Generators\Console\Event;
use Madewithlove\LaravelCqrsEs\Generators\Console\File;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     *
     */
    public function register()
    {
        $this->commands([
            File::class,
            Command::class,
            Event::class,
            Aggregate::class,
        ]);
    }
}
