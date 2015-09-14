<?php

namespace Unbiased\JsonTransportBundle\Exception\Transport\Bridge;

class InvalidTransportBridgeResponseException extends \Exception
{
    /**
     * @param string $rawResponse
     * @param int|null $code
     * @param \Exception|null $previous
     */
    public function __construct($rawResponse, $code = null, \Exception $previous = null)
    {
        parent::__construct(
            'Invalid Transport Bridge Response received: '.substr((string)$rawResponse, 0, 100).'…',
            $code,
            $previous
        );
    }
}