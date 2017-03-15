<?php

namespace Madewithlove\LaravelCqrsEs\Saga;

use Broadway\EventDispatcher\EventDispatcher;
use Broadway\EventDispatcher\EventDispatcherInterface;
use Broadway\EventHandling\EventBus;
use Broadway\EventHandling\EventBusInterface;
use Broadway\Saga\State\RepositoryInterface;
use Broadway\Saga\Metadata\MetadataFactoryInterface;
use Broadway\Saga\Metadata\StaticallyConfiguredSagaMetadataFactory;
use Broadway\Saga\MultipleSagaManager;
use Broadway\Saga\SagaInterface;
use Broadway\Saga\State\StateManager;
use Broadway\Saga\State\StateManagerInterface;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('saga.manager', function () {
            return new SagaManager($this->app);
        });

        $this->app->singleton('saga.driver', function () {
            return $this->app->make('saga.manager')->driver();
        });

        $this->app->alias('saga.driver', RepositoryInterface::class);

        $this->app->bind(MetadataFactoryInterface::class, StaticallyConfiguredSagaMetadataFactory::class);
        $this->app->bind(StateManagerInterface::class, StateManager::class);

        $this->app->singleton(SagaInterface::class, function () {
            $sagas = array_map(function ($saga) {
               return $this->app->make($saga);
            }, config('broadway.saga.sagas', []));

            return new MultipleSagaManager(
                $this->app->make(RepositoryInterface::class),
                $sagas,
                $this->app->make(StateManagerInterface::class),
                $this->app->make(MetadataFactoryInterface::class),
                $this->app->make(EventDispatcher::class)
            );
        });

        $this->app->make(EventBus::class)->subscribe(
            $this->app->make(SagaInterface::class)
        );
    }
}