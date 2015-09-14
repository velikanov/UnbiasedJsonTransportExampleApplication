<?php

namespace Unbiased\JsonTransportBundle\Exception\Transport\Bridge;

class BridgeNotFoundException extends \Exception
{
    /**
     * @param string $bridgeServiceName
     * @param int $bridgeClassName
     * @param int|null $code
     * @param \Exception|null $previous
     */
    public function __construct($bridgeServiceName, $bridgeClassName, $code = null, \Exception $previous = null)
    {
        $message = [];

        if (null !== $bridgeServiceName) {
            $message[] = sprintf('Transport Bridge for Service %s has not been found', $bridgeServiceName);
        }

        if (null !== $bridgeClassName) {
            $message[] = sprintf('Transport Bridge for Class %s has not been found', $bridgeServiceName);
        }

        parent::__construct(implode("\n", $message), $code, $previous);
    }
}