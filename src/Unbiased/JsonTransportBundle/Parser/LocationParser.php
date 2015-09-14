<?php

namespace Unbiased\JsonTransportBundle\Parser;

use Unbiased\JsonTransportBundle\Exception\IncorrectLocationFormatException;
use Unbiased\JsonTransportBundle\Model\Location;

class LocationParser implements JsonParserInterface
{
    protected $coordinateParser;

    public function __construct(JsonParserInterface $coordinateParser)
    {
        $this->coordinateParser = $coordinateParser;
    }

    /**
     * @param \StdClass $locationObject
     * @throws IncorrectLocationFormatException
     * @return Location
     */
    public function parse($locationObject)
    {
        $location = new Location();

        if (!property_exists($locationObject, 'name') || !property_exists($locationObject, 'coordinates')) {
            throw new IncorrectLocationFormatException(json_encode($locationObject));
        }

        $location->setName($locationObject->name);

        $coordinates = $this->coordinateParser->parse($locationObject->coordinates);

        $location->setCoordinates($coordinates);

        return $location;
    }
}