<?php

namespace Unbiased\JsonTransportBundle\Bridge;

abstract class AbstractTransportBridge implements TransportBridgeInterface
{
    public static function getServiceResponder()
    {
        return null;
    }

    public static function getClassResponder()
    {
        return null;
    }
}