<?php

namespace Unbiased\JsonTransportBundle\Bridge\BuzzBundle;

use Unbiased\JsonTransportBundle\Bridge\AbstractTransportBridge;

class BuzzBundleBridge extends AbstractTransportBridge
{
    public static function getServiceResponder()
    {
        return 'buzz';
    }

    public function callUrl($url, $method = 'GET', array $data)
    {
        return 'Buzz';
    }
}