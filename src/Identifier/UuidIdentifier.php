<?php

namespace Madewithlove\LaravelCqrsEs\Identifier;

use Rhumsaa\Uuid\Uuid;

class UuidIdentifier
{
    /**
     * @var Uuid
     */
    protected $value;

    /**
     * @param Uuid $value
     */
    public function __construct(Uuid $value)
    {
        $this->value = $value;
    }

    /**
     * @return static
     */
    public static function generate()
    {
        return new static(Uuid::uuid4());
    }

    /**
     * @param $string
     *
     * @return static
     */
    public static function fromString($string)
    {
        return new static(Uuid::fromString($string));
    }

    /**
     * @param Identifier $identifier
     *
     * @return bool
     */
    public function equals(Identifier $identifier)
    {
        return $this == $identifier;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return $this->value->toString();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value->toString();
    }
}