<?php

namespace Unbiased\JsonTransportBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

class TransportCompilerPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $taggedServices = $container->findTaggedServiceIds('unbiased_json_transport.bridge');

        $serviceBridges = [];
        $classBridges = [];

        foreach ($taggedServices as $taggedServiceName => $taggedService) {
            /** @var Definition $serviceDefinition */
            $serviceDefinition = $container->getDefinition($taggedServiceName);

            $bridgeClassName = $serviceDefinition->getClass();

            if (null !== ($serviceResponder = $bridgeClassName::getServiceResponder())) {
                $serviceBridges[$serviceResponder] = $taggedServiceName;
            }
            if (null !== ($classResponder = $bridgeClassName::getClassResponder())) {
                $classBridges[$classResponder] = $taggedServiceName;
            }
        }

        $container->setParameter('unbiased_json_transport.bridge_collection', [
            'service_responders' => $serviceBridges,
            'class_responders' => $classBridges,
        ]);
    }
}