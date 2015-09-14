<?php

namespace Unbiased\JsonTransportBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('unbiased_json_transport');

        $rootNode
            ->children()
                ->scalarNode('transport_service')->end()
                ->scalarNode('transport_class')->end()
            ->end()
            ->validate()
                ->ifTrue(function($config) {
                    return
                        !array_key_exists('transport_service', $config)
                        &&
                        !array_key_exists('transport_class', $config)
                    ;
                })
                ->thenInvalid('You need to specify transport service name or transport class name')
            ->end()
        ;

        return $treeBuilder;
    }
}
