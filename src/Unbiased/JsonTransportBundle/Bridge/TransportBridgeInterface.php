<?php

namespace Unbiased\JsonTransportBundle\Bridge;

interface TransportBridgeInterface
{
    public function getServiceResponder();
    public function getClassResponder();
}