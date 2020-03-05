<?php

namespace Madewithlove\LaravelCqrsEs\EventStore\Console;

use Illuminate\Console\Command;
use Illuminate\Events\Dispatcher;
use Madewithlove\LaravelCqrsEs\EventStore\Events\PostEventStoreReplay;
use Madewithlove\LaravelCqrsEs\EventStore\Events\PreEventStoreReplay;
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
     * @var Dispatcher
     */
    protected $dispatcher;

    /**
     * @param ReplayService $replayService
     * @param Dispatcher $dispatcher
     */
    public function __construct(ReplayService $replayService, Dispatcher $dispatcher)
    {
        parent::__construct();

        $this->replayService = $replayService;
        $this->dispatcher = $dispatcher;
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

        $this->dispatcher->fire(new PreEventStoreReplay());

        $this->replayService->replay($params);

        $this->dispatcher->fire(new PostEventStoreReplay());
    }
}