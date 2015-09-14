<?php

namespace Unbiased\JsonTransportBundle\Exception\Transport;

class InvalidJsonResponseException extends \Exception
{
    /**
     * @param int $jsonErrorCode
     * @param string $jsonString
     * @param int|null $code
     * @param \Exception|null $previous
     */
    public function __construct($jsonErrorCode, $jsonString, $code = null, \Exception $previous = null)
    {
        parent::__construct(
            sprintf(
                'Invalid JSON Response received (code %d): %s…',
                $jsonErrorCode,
                substr((string)$jsonString, 0, 100)
            ),
            $code,
            $previous
        );
    }
}