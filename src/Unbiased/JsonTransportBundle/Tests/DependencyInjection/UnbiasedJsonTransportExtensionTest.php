<?php

namespace Unbiased\JsonTransportBundle\Tests\DependencyInjection;

use Unbiased\JsonTransportBundle\DependencyInjection\UnbiasedJsonTransportExtension;
use Unbiased\JsonTransportBundle\Tests\AbstractContainerAwareTest;

class UnbiasedJsonTransportExtensionTest extends AbstractContainerAwareTest
{
    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testJsonTransportThrowsExceptionUnlessTransportServiceOrClassSet()
    {
        $container = $this->getContainer();
        $loader = new UnbiasedJsonTransportExtension();
        $config = $this->getFullConfig();

        unset($config['transport_service']);
        unset($config['transport_class']);

        $loader->load([
            $config,
        ], $container);
        $this->processContainer($container);
    }

    /**
     * @expectedException \Unbiased\JsonTransportBundle\Exception\TransportNotFoundException
     */
    public function testJsonTransportThrowsExceptionUnlessTransportServiceExists()
    {
        $container = $this->getContainer();
        $loader = new UnbiasedJsonTransportExtension();
        $config = $this->getFullConfig();

        $config['transport_service'] = 'inexistent_service_'.uniqid();

        $loader->load([
            $config,
        ], $container);
        $this->processContainer($container);
    }

    /**
     * @expectedException \Unbiased\JsonTransportBundle\Exception\TransportNotFoundException
     */
    public function testJsonTransportThrowsExceptionUnlessTransportClassExists()
    {
        $container = $this->getContainer();
        $loader = new UnbiasedJsonTransportExtension();
        $config = $this->getFullConfig();

        unset($config['transport_service']);
        $config['transport_class'] = '\InexistentClass'.uniqid();

        $loader->load([
            $config,
        ], $container);
        $this->processContainer($container);
    }
}
