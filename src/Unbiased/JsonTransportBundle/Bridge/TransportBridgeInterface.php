<?php

namespace Unbiased\JsonTransportBundle\Bridge;

interface TransportBridgeInterface
{
    public static function getServiceResponder();
    public static function getClassResponder();

    public function callUrl($url, $method = 'GET', array $data);
}