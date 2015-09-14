<?php

namespace Unbiased\JsonTransportBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RequestDataCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('unbiased_json_transport:request_data_command')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $remoteRequestManager = $this->getContainer()->get('unbiased_json_transport.remote_request_manager');

        echo $remoteRequestManager->getResponse('http://ya.ru');
    }
}
