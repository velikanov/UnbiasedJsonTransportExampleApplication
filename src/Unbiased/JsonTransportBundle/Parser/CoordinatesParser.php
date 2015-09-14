<?php

namespace Unbiased\JsonTransportBundle\Parser;

use Unbiased\JsonTransportBundle\Exception\IncorrectCoordinateFormatException;
use Unbiased\JsonTransportBundle\Model\Coordinates;

class CoordinatesParser implements JsonParserInterface
{
    /**
     * @param \StdClass $coordinatesObject
     * @throws IncorrectCoordinateFormatException
     * @return Coordinates
     */
    public function parse($coordinatesObject)
    {
        $coordinates = new Coordinates();

        if (!property_exists($coordinatesObject, 'lat') || !property_exists($coordinatesObject, 'long')) {
            throw new IncorrectCoordinateFormatException(json_encode($coordinatesObject));
        }

        if (!is_numeric($coordinatesObject->lat) || !is_numeric($coordinatesObject->long)) {
            throw new IncorrectCoordinateFormatException(json_encode($coordinatesObject));
        }

        $coordinates->setLatitude($coordinatesObject->lat);
        $coordinates->setLongitude($coordinatesObject->long);

        return $coordinates;
    }
}