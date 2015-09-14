<?php

namespace Unbiased\JsonTransportBundle\Exception;

class BridgeNotFoundException extends \Exception
{
    public function __construct($bridgeServiceName, $bridgeClassName, $code = null, \Exception $previous = null)
    {
        $message = [];

        if (null !== $bridgeServiceName) {
            $message[] = sprintf('Transport Bridge for Service %s has not been found', $bridgeServiceName);
        }

        if (null !== $bridgeClassName) {
            $message[] = sprintf('Transport Bridge for Class %s has not been found', $bridgeServiceName);
        }

        parent::__construct($message, $code, $previous);
    }
}