<?php

namespace Unbiased\JsonTransportBundle\Manager;

use Unbiased\JsonTransportBundle\Bridge\TransportBridgeFactory;
use Unbiased\JsonTransportBundle\Bridge\TransportBridgeInterface;
use Unbiased\JsonTransportBundle\Exception\Transport\Bridge\BridgeNotFoundException;

class RemoteRequestManager
{
    /** @var string $transportServiceName */
    protected $transportServiceName;
    /** @var string $transportClassName */
    protected $transportClassName;
    /** @var array $bridgeCollection */
    protected $bridgeCollection;
    /** @var TransportBridgeInterface $bridge */
    protected $bridge;
    /** @var TransportBridgeFactory $transportBridgeFactory */
    protected $transportBridgeFactory;

    /**
     * @param string $transportServiceName
     * @param string $transportClassName
     * @param array $bridgeCollection
     * @param TransportBridgeFactory $transportBridgeFactory
     */
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

    /**
     * @param string $url
     * @param string $method
     * @param array $data
     * @return string
     * @throws BridgeNotFoundException
     */
    public function getResponse($url, $method = 'GET', $data = [])
    {
        $bridge = $this->getBridge();

        $response = $bridge->callUrl($url, $method, $data);

        return $response;
    }

    /**
     * @return TransportBridgeInterface
     * @throws BridgeNotFoundException
     */
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

    /**
     * @param string $scope
     * @param string $bridgeServiceObjectName
     * @return TransportBridgeInterface|null
     */
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