<?php

namespace Unbiased\JsonTransportBundle\Bridge;

abstract class AbstractTransportBridge implements TransportBridgeInterface
{
    public function getServiceResponder()
    {
        return null;
    }

    public function getClassResponder()
    {
        return null;
    }
}