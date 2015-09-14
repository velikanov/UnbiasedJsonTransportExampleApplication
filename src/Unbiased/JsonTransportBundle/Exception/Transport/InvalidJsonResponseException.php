<?php

namespace Unbiased\JsonTransportBundle\Exception\Transport;

class InvalidJsonResponseException extends \Exception
{
    public function __construct($jsonString, $code = null, \Exception $previous = null)
    {
        parent::__construct(
            'Invalid JSON Response received: '.substr((string)$jsonString, 0, 100).'…',
            $code,
            $previous
        );
    }
}