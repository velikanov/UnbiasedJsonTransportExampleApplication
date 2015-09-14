<?php

namespace Unbiased\JsonTransportBundle\Tests;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Yaml\Parser;
use Unbiased\JsonTransportBundle\DependencyInjection\Compiler\TransportCompilerPass;
use Unbiased\JsonTransportBundle\DependencyInjection\Compiler\ValidationPass;

abstract class AbstractContainerAwareTest extends \PHPUnit_Framework_TestCase
{
    /**
     * getFullConfig
     *
     * @return array
     */
    protected function getFullConfig()
    {
        $yaml = <<<EOF
transport_service: buzz
transport_class: \GuzzleHttp\Client
EOF;
        $parser = new Parser();

        return $parser->parse($yaml);
    }

    /**
     * getContainer
     *
     * @return ContainerBuilder
     */
    protected function getContainer()
    {
        $container = new ContainerBuilder();
        $container->register('buzz');

        return $container;
    }

    /**
     * @param ContainerBuilder $container
     * @throws \Unbiased\JsonTransportBundle\Exception\Transport\TransportNotFoundException
     */
    protected function processContainer(ContainerBuilder $container)
    {
        $validationPass = new ValidationPass();
        $validationPass->process($container);

        $transportCompilerPass = new TransportCompilerPass();
        $transportCompilerPass->process($container);
    }
}