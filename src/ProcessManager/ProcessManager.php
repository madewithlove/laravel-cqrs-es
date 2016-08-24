<?php


use Broadway\Domain\DomainMessage;
use Broadway\EventHandling\EventListenerInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Madewithlove\LaravelCqrsEs\Inflectors\MethodNameInflector;

abstract class ProcessManager implements EventListenerInterface
{
    /**
     * @var MethodNameInflector
     */
    private $methodNameInflector;

    /**
     * ProcessManager constructor.
     * @param MethodNameInflector $methodNameInflector
     */
    public function __construct(MethodNameInflector $methodNameInflector)
    {
        $this->methodNameInflector = $methodNameInflector;
    }

    /**
     * @param DomainMessage $domainMessage
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