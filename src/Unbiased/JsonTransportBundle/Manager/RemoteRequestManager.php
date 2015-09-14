<?php

namespace Unbiased\JsonTransportBundle\Manager;

use Unbiased\JsonTransportBundle\Bridge\TransportBridgeInterface;

class RemoteRequestManager
{
    protected $transportServiceName;
    protected $transportClassName;
    protected $bridgeCollection;
    /** @var TransportBridgeInterface $bridge */
    protected $bridge;

    public function __construct($transportServiceName, $transportClassName, $bridgeCollection)
    {
        $this->transportServiceName = $transportServiceName;
        $this->transportClassName = $transportClassName;
        $this->bridgeCollection = $bridgeCollection;
        $this->bridge = null;
    }

    public function getResponse($url, $method = 'GET', $data = [])
    {
        $this->getBridge();
    }

    protected function getBridge()
    {
        if (null !== $this->bridge) {
            return $this->bridge;
        } else {
            /** @var TransportBridgeInterface $bridge */
            foreach ($this->bridgeCollection as $bridge) {
                echo $bridge->getServiceResponder();
            }
        }
    }
}