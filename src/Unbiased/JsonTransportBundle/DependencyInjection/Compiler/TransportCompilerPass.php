<?php

namespace Unbiased\JsonTransportBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class TransportCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $taggedServices = $container->findTaggedServiceIds('unbiased_json_transport.bridge');

        $container->setParameter('unbiased_json_transport.bridge_collection', $taggedServices);
    }
}