<?php

namespace Unbiased\JsonTransportBundle\Exception\Transport;

class TransportNotFoundException extends \Exception
{
    const TRANSPORT_SERVICE = 'service';
    const TRANSPORT_CLASS = 'class';

    /**
     * @param string $transportType
     * @param int $transportName
     * @param int|null $code
     * @param \Exception|null $previous
     */
    public function __construct($transportType, $transportName, $code = null, \Exception $previous = null)
    {
        $message = sprintf('Transport %s `%s` not found!', $transportType, $transportName);

        parent::__construct($message, $code, $previous);
    }
}