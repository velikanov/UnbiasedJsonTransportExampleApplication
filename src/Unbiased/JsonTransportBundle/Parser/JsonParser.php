<?php

namespace Unbiased\JsonTransportBundle\Parser;

use Unbiased\JsonTransportBundle\Exception\Transport\InvalidJsonResponseException;
use Unbiased\JsonTransportBundle\Exception\Transport\MalformedJsonResponseException;
use Unbiased\JsonTransportBundle\Exception\Transport\UnsuccessfulJsonResponseException;
use Unbiased\JsonTransportBundle\Model\SampleObject;
use Unbiased\JsonTransportBundle\Validator\JsonValidatorInterface;

class JsonParser implements JsonParserInterface
{
    /** @var JsonParserInterface $locationParser */
    protected $locationParser;
    /** @var JsonValidatorInterface $jsonValidator */
    protected $jsonResponseValidator;

    /**
     * @param JsonParserInterface $locationParser
     * @param JsonValidatorInterface $jsonResponseValidator
     */
    public function __construct(JsonParserInterface $locationParser, JsonValidatorInterface $jsonResponseValidator)
    {
        $this->locationParser = $locationParser;
        $this->jsonResponseValidator = $jsonResponseValidator;
    }

    /**
     * @param string $jsonString
     * @return SampleObject
     * @throws InvalidJsonResponseException
     * @throws MalformedJsonResponseException
     * @throws UnsuccessfulJsonResponseException
     */
    public function parse($jsonString)
    {
        if ($jsonArray = json_decode($jsonString)) {
            if ($this->jsonResponseValidator->validate($jsonArray)) {
                $sampleObject = new SampleObject();

                foreach ($jsonArray->data->locations as $jsonLocation) {
                    $location = $this->locationParser->parse($jsonLocation);

                    $sampleObject->addLocation($location);
                }

                return $sampleObject;
            }
        }

        throw new InvalidJsonResponseException(json_last_error(), $jsonString);
    }
}