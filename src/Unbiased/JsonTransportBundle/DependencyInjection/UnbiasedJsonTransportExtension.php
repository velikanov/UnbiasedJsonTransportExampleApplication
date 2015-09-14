<?php

namespace Unbiased\JsonTransportBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class UnbiasedJsonTransportExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $transportServiceParameter = null;
        $transportClassParameter = null;

        if (array_key_exists('transport_service', $config)) {
            $transportServiceParameter = $config['transport_service'];
        } elseif (array_key_exists('transport_class', $config)) {
            $transportClassParameter = $config['transport_class'];
        }

        $container->setParameter('unbiased_json_transport.transport_service', $transportServiceParameter);
        $container->setParameter('unbiased_json_transport.transport_class', $transportClassParameter);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
    }
}
