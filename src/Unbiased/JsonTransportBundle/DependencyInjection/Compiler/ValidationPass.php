<?php

namespace Unbiased\JsonTransportBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Unbiased\JsonTransportBundle\Exception\Transport\TransportNotFoundException;

class ValidationPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     * @throws TransportNotFoundException
     */
    public function process(ContainerBuilder $container)
    {
        if (
            $container->hasParameter('unbiased_json_transport.transport_service')
            &&
            null !== ($transportServiceName = $container->getParameter('unbiased_json_transport.transport_service'))
        ) {
            if (!$container->has($transportServiceName)) {
                throw new TransportNotFoundException(
                    TransportNotFoundException::TRANSPORT_SERVICE,
                    $transportServiceName
                );
            }
        } elseif (
            $container->hasParameter('unbiased_json_transport.transport_class')
            &&
            null !== ($transportClassName = $container->getParameter('unbiased_json_transport.transport_class'))
        ) {
            $transportClassName = $container->getParameter('unbiased_json_transport.transport_class');

            if (!class_exists($transportClassName)) {
                throw new TransportNotFoundException(
                    TransportNotFoundException::TRANSPORT_CLASS,
                    $transportClassName
                );
            }
        }
    }
}