<?php

namespace Unbiased\JsonTransportBundle\Parser;

use Unbiased\JsonTransportBundle\Exception\IncorrectLocationFormatException;
use Unbiased\JsonTransportBundle\Exception\Transport\InvalidJsonResponseException;
use Unbiased\JsonTransportBundle\Exception\Transport\MalformedJsonResponseException;
use Unbiased\JsonTransportBundle\Exception\Transport\UnsuccessfulJsonResponseException;
use Unbiased\JsonTransportBundle\Model\SampleObject;

class JsonParser implements JsonParserInterface
{
    protected $locationParser;

    public function __construct(JsonParserInterface $locationParser)
    {
        $this->locationParser = $locationParser;
    }

    public function parse($jsonString)
    {
        if ($jsonArray = json_decode($jsonString)) {
            if (!property_exists($jsonArray, 'success')) {
                throw new MalformedJsonResponseException($jsonString);
            }

            if (true !== $jsonArray->success) {
                if (
                    property_exists($jsonArray, 'data')
                    &&
                    property_exists($jsonArray->data, 'message')
                    &&
                    property_exists($jsonArray->data, 'code')
                ) {
                    throw new UnsuccessfulJsonResponseException(
                        $jsonArray->data->message,
                        $jsonArray->data->code
                    );
                }

                throw new MalformedJsonResponseException($jsonString);
            }

            if (
                !property_exists($jsonArray, 'data')
                ||
                (
                    property_exists($jsonArray, 'data')
                    &&
                    !property_exists($jsonArray->data, 'locations')
                )
            ) {
                throw new MalformedJsonResponseException($jsonString);
            }

            if (
                property_exists($jsonArray->data, 'locations')
                &&
                !is_array($jsonArray->data->locations)
            ) {
                throw new MalformedJsonResponseException(json_encode($jsonArray->data->locations));
            }

            $sampleObject = new SampleObject();

            foreach ($jsonArray->data->locations as $jsonLocation) {
                $location = $this->locationParser->parse($jsonLocation);

                $sampleObject->addLocation($location);
            }

            return $sampleObject;
        }

        throw new InvalidJsonResponseException($jsonString);
    }
}