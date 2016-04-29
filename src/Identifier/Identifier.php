<?php

namespace Madewithlove\LaravelCqrsEs\Identifier;

use Broadway\Serializer\SerializableInterface;

interface Identifier extends SerializableInterface
{
    /**
     * @return static
     */
    public static function generate();

    /**
     * @param $string
     *
     * @return static
     */
    public static function fromString($string);

    /**
     * @param Identifier $identifier
     *
     * @return bool
     */
    public function equals(Identifier $identifier);

    /**
     * @return string
     */
    public function toString();
}