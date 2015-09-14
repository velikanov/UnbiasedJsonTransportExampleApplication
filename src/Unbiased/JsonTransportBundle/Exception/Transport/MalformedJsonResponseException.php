<?php

namespace Unbiased\JsonTransportBundle\Exception\Transport;

class MalformedJsonResponseException extends \Exception
{
    /**
     * @param string $jsonString
     * @param int|null $code
     * @param \Exception|null $previous
     */
    public function __construct($jsonString, $code = null, \Exception $previous = null)
    {
        parent::__construct(
            'Malformed JSON Response received: '.substr((string)$jsonString, 0, 100).'…',
            $code,
            $previous
        );
    }
}