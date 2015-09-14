<?php

namespace Unbiased\JsonTransportBundle\Tests\Manager;

use Unbiased\JsonTransportBundle\DependencyInjection\UnbiasedJsonTransportExtension;
use Unbiased\JsonTransportBundle\Tests\AbstractContainerAwareTest;

class RemoteRequestManagerTest extends AbstractContainerAwareTest
{
    public function testSelectBuzzBundleBridge()
    {
        $container = $this->getContainer();
        $loader = new UnbiasedJsonTransportExtension();
        $config = $this->getFullConfig();

        $container
            ->register(
                'unbiased_json_transport.buzz_bundle_bridge',
                '\Unbiased\JsonTransportBundle\Bridge\BuzzBundle\BuzzBundleBridge'
            )
            ->addTag('unbiased_json_transport.bridge')
        ;
        $container
            ->register(
                'unbiased_json_transport.guzzle_bridge',
                '\Unbiased\JsonTransportBundle\Bridge\Guzzle\GuzzleBridge'
            )
            ->addTag('unbiased_json_transport.bridge')
        ;

        $container
            ->register(
                'unbiased_json_transport.remote_request_manager',
                '\Unbiased\JsonTransportBundle\Manager\RemoteRequestManager'
            )
            ->addArgument($config['transport_service'])
            ->addArgument($config['transport_class'])
            ->addArgument($container->findTaggedServiceIds('unbiased_json_transport.bridge'))
        ;

        $remoteRequestManager = $container->get('unbiased_json_transport.remote_request_manager');

        $remoteRequestManager->getResponse('http://ya.ru');

        $loader->load([
            $config,
        ], $container);
        $this->processContainer($container);
    }
}
