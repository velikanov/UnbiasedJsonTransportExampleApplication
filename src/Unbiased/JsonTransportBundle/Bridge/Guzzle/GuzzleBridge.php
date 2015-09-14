<?php

namespace Unbiased\JsonTransportBundle\Bridge\Guzzle;

use Unbiased\JsonTransportBundle\Bridge\AbstractTransportBridge;

class GuzzleBridge extends AbstractTransportBridge
{
    public static function getClassResponder()
    {
        return '\GuzzleHttp\Client';
    }

    public function callUrl($url, $method = 'GET', array $data)
    {
        return 'Guzzle';
    }
}