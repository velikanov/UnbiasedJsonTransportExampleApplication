<?php

namespace Unbiased\JsonTransportBundle\Exception;

class IncorrectLocationFormatException extends \Exception
{
    /**
     * @param string $locationJsonString
     * @param int|null $code
     * @param \Exception|null $previous
     */
    public function __construct($locationJsonString, $code = null, \Exception $previous = null)
    {
        parent::__construct(
            'Incorrect Location format received: '.substr((string)$locationJsonString, 0, 100).'…',
            $code,
            $previous
        );
    }
}