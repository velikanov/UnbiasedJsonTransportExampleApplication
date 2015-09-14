<?php

namespace Unbiased\JsonTransportBundle\Exception;

class InvalidTransportBridgeResponseException extends \Exception
{
    public function __construct($rawResponse, $code = null, \Exception $previous = null)
    {
        parent::__construct(
            'Invalid Transport Bridge Response received: '.substr((string)$rawResponse, 0, 100).'…',
            $code,
            $previous
        );
    }
}