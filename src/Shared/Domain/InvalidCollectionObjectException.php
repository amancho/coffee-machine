<?php

namespace Adsmurai\Shared\Domain;

class InvalidCollectionObjectException extends \Exception
{

    /**
     * @param mixed $object
     * @param string $type
     */
    public function __construct(mixed $current, string $expected)
    {
        parent::__construct(
            sprintf('"%s" is not a valid object for collection. Expected "%s"', get_class($current), $expected)
        );
    }
}