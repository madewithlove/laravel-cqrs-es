<?php

namespace Madewithlove\LaravelCqrsEs\EventStore\Console;

use Illuminate\Console\Command;
use Illuminate\Contracts\Container\Container;
use Madewithlove\LaravelCqrsEs\EventStore\Services\Replay as ReplayService;

class Replay extends Command
{
    /**
     * The console command name.
     * @var string
     */
    protected $signature = 'event-store:replay {id?} {--types=}';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'Replay projections for an entity';

    /**
     * @var ReplayService
     */
    protected $replayService;

    /**
     * @var Container
     */
    protected $container;

    /**
     * @param ReplayService $replayService
     * @param Container $container
     */
    public function __construct(ReplayService $replayService, Container $container)
    {
        parent::__construct();

        $this->replayService = $replayService;
        $this->container = $container;
    }

    /**
     * @return void
     */
    public function handle()
    {
        $params = [];

        if ($id = $this->argument('id')) {
            $params['id'] = explode(',', $id);
        }

        if ($types = $this->option('types')) {
            $params['types'] = explode(',', $types);
        }

        $this->replayService->replay($params);
    }
}