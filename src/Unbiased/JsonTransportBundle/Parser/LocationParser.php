<?php

namespace Unbiased\JsonTransportBundle\Parser;

use Unbiased\JsonTransportBundle\Exception\IncorrectLocationFormatException;
use Unbiased\JsonTransportBundle\Model\Location;
use Unbiased\JsonTransportBundle\Validator\JsonValidatorInterface;

class LocationParser implements JsonParserInterface
{
    /** @var JsonParserInterface $coordinateParser */
    protected $coordinatesParser;
    /** @var JsonValidatorInterface $jsonValidator */
    protected $jsonLocationValidator;

    /**
     * @param JsonParserInterface $coordinatesParser
     * @param JsonValidatorInterface $jsonLocationValidator
     */
    public function __construct(JsonParserInterface $coordinatesParser, JsonValidatorInterface $jsonLocationValidator)
    {
        $this->coordinatesParser = $coordinatesParser;
        $this->jsonLocationValidator = $jsonLocationValidator;
    }

    /**
     * @param \StdClass $locationObject
     * @throws IncorrectLocationFormatException
     * @return Location
     */
    public function parse($locationObject)
    {
        $location = new Location();

        if ($this->jsonLocationValidator->validate($locationObject)) {
            $location->setName($locationObject->name);

            $coordinates = $this->coordinatesParser->parse($locationObject->coordinates);

            $location->setCoordinates($coordinates);
        }

        return $location;
    }
}