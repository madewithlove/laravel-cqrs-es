<?php
namespace Madewithlove\LaravelCqrsEs\ProcessManager;

use Broadway\Domain\DomainMessage;
use Madewithlove\LaravelCqrsEs\Inflectors\Traits\UsesInflector;
use Madewithlove\LaravelCqrsEs\ProcessManager\Contracts\ProcessManager as ProcessManagerContract;

abstract class ProcessManager implements ProcessManagerContract
{
    use UsesInflector;

    /**
     * @param DomainMessage $domainMessage
     */
    public function handle(DomainMessage $domainMessage)
    {
        $event = $domainMessage->getPayload();
        $method = $this->methodNameInflector->inflect($event);

        if (!method_exists($this, $method)) {
            return;
        }

        $this->$method($event, $domainMessage);
    }
}