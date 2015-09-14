<?php

namespace Unbiased\JsonTransportBundle\Manager;

use Unbiased\JsonTransportBundle\Bridge\TransportBridgeFactory;
use Unbiased\JsonTransportBundle\Bridge\TransportBridgeInterface;
use Unbiased\JsonTransportBundle\Exception\BridgeNotFoundException;

class RemoteRequestManager
{
    protected $transportServiceName;
    protected $transportClassName;

    /** @var array $bridgeCollection */
    protected $bridgeCollection;
    /** @var TransportBridgeInterface $bridge */
    protected $bridge;
    /** @var TransportBridgeFactory $transportBridgeFactory */
    protected $transportBridgeFactory;

    public function __construct(
        $transportServiceName,
        $transportClassName,
        array $bridgeCollection,
        TransportBridgeFactory $transportBridgeFactory
    )
    {
        $this->transportServiceName = $transportServiceName;
        $this->transportClassName = $transportClassName;
        $this->bridgeCollection = $bridgeCollection;
        $this->bridge = null;
        $this->transportBridgeFactory = $transportBridgeFactory;
    }

    public function getResponse($url, $method = 'GET', $data = [])
    {
        $bridge = $this->getBridge();

        $response = $bridge->callUrl($url, $method, $data);

        return $response;
    }

    protected function getBridge()
    {
        if (null !== $this->bridge) {
            return $this->bridge;
        } else {
            if (null !== ($bridgeService = $this->getBridgeService(
                    'service_responders',
                    $this->transportServiceName
                ))) {
                return $bridgeService;
            }

            if (null !== ($bridgeService = $this->getBridgeService(
                    'class_responders',
                    $this->transportClassName
                ))) {
                return $bridgeService;
            }

            throw new BridgeNotFoundException($this->transportServiceName, $this->transportClassName);
        }
    }

    protected function getBridgeService($scope, $bridgeServiceObjectName)
    {
        if (null !== $bridgeServiceObjectName) {
            $bridge = $this->transportBridgeFactory->createBridge(
                $this->bridgeCollection[$scope][$bridgeServiceObjectName]
            );

            if (null !== $bridge) {
                return $bridge;
            }
        }
    }
}