<?php

namespace Unbiased\JsonTransportBundle\Bridge;

use Symfony\Component\DependencyInjection\ContainerInterface;

class TransportBridgeFactory
{
    /** @var ContainerInterface $container */
    protected static $container;

    public static function createBridge($bridgeName)
    {
        if (self::$container->has($bridgeName)) {
            return self::$container->get($bridgeName);
        }

        return null;
    }

    public function setContainer(ContainerInterface $container)
    {
        self::$container = $container;
    }
}
