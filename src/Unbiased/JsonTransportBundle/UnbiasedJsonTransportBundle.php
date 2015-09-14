<?php

namespace Unbiased\JsonTransportBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Unbiased\JsonTransportBundle\DependencyInjection\Compiler\TransportCompilerPass;
use Unbiased\JsonTransportBundle\DependencyInjection\Compiler\ValidationPass;

class UnbiasedJsonTransportBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new ValidationPass());
        $container->addCompilerPass(new TransportCompilerPass());
    }
}
