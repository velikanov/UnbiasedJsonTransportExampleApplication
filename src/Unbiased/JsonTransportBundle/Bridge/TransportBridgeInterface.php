<?php

namespace Unbiased\JsonTransportBundle\Bridge;

interface TransportBridgeInterface
{
    /**
     * @return string
     */
    public static function getServiceResponder();

    /**
     * @return string
     */
    public static function getClassResponder();

    /**
     * @param string $url
     * @param string $method
     * @param array $data
     * @return string
     */
    public function callUrl($url, $method = 'GET', array $data);
}