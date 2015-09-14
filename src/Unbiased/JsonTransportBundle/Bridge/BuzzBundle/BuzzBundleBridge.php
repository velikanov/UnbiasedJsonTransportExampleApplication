<?php

namespace Unbiased\JsonTransportBundle\Bridge\BuzzBundle;

use Unbiased\JsonTransportBundle\Bridge\AbstractTransportBridge;

class BuzzBundleBridge extends AbstractTransportBridge
{
    public function getServiceResponder()
    {
        return 'buzz';
    }
}