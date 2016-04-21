<?php

namespace Madewithlove\LaravelCqrsSe\Identifier;

interface Identifier
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