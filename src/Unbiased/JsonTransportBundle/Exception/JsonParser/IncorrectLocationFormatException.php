<?php

namespace Unbiased\JsonTransportBundle\Exception;

class IncorrectLocationFormatException extends \Exception
{
    public function __construct($locationJsonString, $code = null, \Exception $previous = null)
    {
        parent::__construct(
            'Incorrect Location format received: '.substr((string)$locationJsonString, 0, 100).'…',
            $code,
            $previous
        );
    }
}