<?php

namespace Unbiased\JsonTransportBundle\Exception;

class IncorrectCoordinateFormatException extends \Exception
{
    public function __construct($locationJsonString, $code = null, \Exception $previous = null)
    {
        parent::__construct(
            'Incorrect Coordinate format received: '.substr((string)$locationJsonString, 0, 100).'…',
            $code,
            $previous
        );
    }
}