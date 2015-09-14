<?php

namespace Unbiased\JsonTransportBundle\Validator;

use Unbiased\JsonTransportBundle\Exception\IncorrectCoordinatesFormatException;

class JsonCoordinatesValidator implements JsonValidatorInterface
{
    /**
     * @param \stdClass $jsonCoordinatesObject
     * @return bool
     * @throws IncorrectCoordinatesFormatException
     */
    public function validate($jsonCoordinatesObject)
    {
        if (!property_exists($jsonCoordinatesObject, 'lat') || !property_exists($jsonCoordinatesObject, 'long')) {
            throw new IncorrectCoordinatesFormatException(
                'JSON Coordinates response must contain latitude and longitude'
            );
        }

        if (!is_numeric($jsonCoordinatesObject->lat) || !is_numeric($jsonCoordinatesObject->long)) {
            throw new IncorrectCoordinatesFormatException('JSON Coordinates latitude and longitude must be numeric');
        }

        return true;
    }
}