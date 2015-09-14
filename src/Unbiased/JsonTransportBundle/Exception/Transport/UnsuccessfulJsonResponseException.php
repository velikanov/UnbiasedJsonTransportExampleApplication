<?php

namespace Unbiased\JsonTransportBundle\Exception\Transport;

class UnsuccessfulJsonResponseException extends \Exception
{
    /**
     * @param string $message
     * @param int $errorCode
     * @param int|null $code
     * @param \Exception|null $previous
     */
    public function __construct($message, $errorCode, $code = null, \Exception $previous = null)
    {
        parent::__construct(
            sprintf(
                'Unsuccessful JSON Response received (code %s): %s…',
                $errorCode,
                $message
            ),
            $code,
            $previous
        );
    }
}