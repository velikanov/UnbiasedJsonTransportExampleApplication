<?php

namespace Unbiased\JsonTransportBundle\Bridge\Guzzle;

use Unbiased\JsonTransportBundle\Bridge\AbstractTransportBridge;

class GuzzleBridge extends AbstractTransportBridge
{
    public function getClassResponder()
    {
        return '\GuzzleHttp\Client';
    }
}