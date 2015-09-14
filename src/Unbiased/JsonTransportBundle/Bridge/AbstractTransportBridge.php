<?php

namespace Unbiased\JsonTransportBundle\Bridge;

abstract class AbstractTransportBridge implements TransportBridgeInterface
{
    /**
     * @return null
     */
    public static function getServiceResponder()
    {
        return null;
    }

    /**
     * @return null
     */
    public static function getClassResponder()
    {
        return null;
    }
}