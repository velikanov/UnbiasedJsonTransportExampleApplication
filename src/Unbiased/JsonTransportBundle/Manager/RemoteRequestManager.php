<?php

namespace Unbiased\JsonTransportBundle\Manager;

use Symfony\Component\DependencyInjection\ContainerInterface;
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
    /** @var ContainerInterface $container */
    protected $container;
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

    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
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
            if (null !== $this->transportServiceName && $this->container->has($this->bridgeCollection['service_responders'][$this->transportServiceName])) {
                return $this->container->get($this->bridgeCollection['service_responders'][$this->transportServiceName]);
            }

            if (null !== $this->transportClassName && $this->container->has($this->bridgeCollection['class_responders'][$this->transportClassName])) {
                return $this->container->get($this->bridgeCollection['class_responders'][$this->transportClassName]);
            }

            throw new BridgeNotFoundException($this->transportServiceName, $this->transportClassName);
        }
    }
}