<?php

namespace Unbiased\JsonTransportBundle\Bridge;

use Symfony\Component\DependencyInjection\ContainerInterface;

class TransportBridgeFactory
{
    /** @var ContainerInterface $container */
    protected static $container;

    /**
     * @param $bridgeName
     * @return TransportBridgeInterface|null
     */
    public static function createBridge($bridgeName)
    {
        if (self::$container->has($bridgeName)) {
            return self::$container->get($bridgeName);
        }

        return null;
    }

    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container)
    {
        self::$container = $container;
    }
}
