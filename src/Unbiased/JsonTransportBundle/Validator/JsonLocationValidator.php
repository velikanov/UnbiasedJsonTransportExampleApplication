<?php

namespace Unbiased\JsonTransportBundle\Validator;

use Unbiased\JsonTransportBundle\Exception\IncorrectLocationFormatException;

class JsonLocationValidator implements JsonValidatorInterface
{
    /**
     * @param \stdClass $jsonLocationObject
     * @return bool
     * @throws IncorrectLocationFormatException
     */
    public function validate($jsonLocationObject)
    {
        if (!property_exists($jsonLocationObject, 'name') || !property_exists($jsonLocationObject, 'coordinates')) {
            throw new IncorrectLocationFormatException('JSON Location object doesn\'t contain name or coordinates');
        }

        return true;
    }
}