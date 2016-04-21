<?php
use Broadway\Domain\DomainMessage;
use Broadway\ReadModel\ProjectorInterface;

/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 20/04/16
 * Time: 16:24
 */
class Projector implements ProjectorInterface
{
    /**
     * {@inheritDoc}
     */
    public function handle(DomainMessage $domainMessage)
    {
        $event  = $domainMessage->getPayload();
        $method = $this->getHandleMethod($event);

        if (! method_exists($this, $method)) {
            return;
        }

        $this->$method($event, $domainMessage);
    }

    private function getHandleMethod($event)
    {
        $classParts = explode('\\', get_class($event));

        return 'project' . end($classParts);
    }
}