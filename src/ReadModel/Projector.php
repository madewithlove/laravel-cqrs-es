<?php

namespace Madewithlove\LaravelCqrsEs\ReadModel;

use Broadway\Domain\DomainMessage;
use Madewithlove\LaravelCqrsEs\Inflectors\Traits\UsesInflector;
use Madewithlove\LaravelCqrsEs\ReadModel\Contracts\Projector as ProjectorContract;

abstract class Projector implements ProjectorContract
{
    use UsesInflector;
    
    /**
     * {@inheritDoc}
     */
    public function handle(DomainMessage $domainMessage)
    {
        $event  = $domainMessage->getPayload();
        $method = $this->methodNameInflector->inflect($event);

        if (! method_exists($this, $method)) {
            return;
        }

        $this->$method($event, $domainMessage);
    }
}