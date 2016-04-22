<?php

namespace Madewithlove\LaravelCqrsEs\ReadModel;

use Broadway\Domain\DomainMessage;
use Broadway\ReadModel\ProjectorInterface;

class Projector implements ProjectorInterface
{
    /**
     * @var MethodNameInflector
     */
    private $methodNameInflector;

    /**
     * Projector constructor.
     * @param $methodNameInflector
     */
    public function __construct(MethodNameInflector $methodNameInflector)
    {
        $this->methodNameInflector = $methodNameInflector;
    }
    
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