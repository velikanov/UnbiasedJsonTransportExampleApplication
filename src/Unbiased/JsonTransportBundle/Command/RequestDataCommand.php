<?php

namespace Unbiased\JsonTransportBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Unbiased\JsonTransportBundle\Model\Location;
use Unbiased\JsonTransportBundle\Model\SampleObject;

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
        $container = $this->getContainer();

        $remoteRequestManager = $container->get('unbiased_json_transport.remote_request_manager');

        $rawResponse = $remoteRequestManager->getResponse('http://ya.ru');

        $jsonParser = $container->get('unbiased_json_transport.json_parser');

        $test = '{
            "data": {
                "locations": [
                    {
                        "name": "Eiffel Tower",
                        "coordinates": {
                            "lat": 21.12,
                            "long": 19.56
                        }
                    },
                    {
                        "name": "Kremlin",
                        "coordinates": {
                            "lat": 55.45,
                            "long": 37.37
                        }
                    }
                ]
            },
            "success": true
        }
        ';

//        $test = '{
//            "data": {
//                "message": "hello",
//                "code": "code"
//            },
//            "success": false
//        }
//        ';

        /** @var SampleObject $sampleObject */
//        $sampleObject = $jsonParser->parse($rawResponse);
        $sampleObject = $jsonParser->parse($test);

        /** @var Location $location */
        foreach ($sampleObject->getLocations() as $location) {
            $coordinates = $location->getCoordinates();

            $output->writeln('Location <info>'.$location->getName().'</info>');
            $output->writeln(sprintf(
                'Coordinates <info>lat: %0.2f, long: %0.2f</info>',
                $coordinates->getLatitude(),
                $coordinates->getLongitude()
            ));
        }
    }
}
