<?php

namespace Unbiased\JsonTransportBundle\Parser;

use Unbiased\JsonTransportBundle\Model\Coordinates;
use Unbiased\JsonTransportBundle\Validator\JsonValidatorInterface;

class CoordinatesParser implements JsonParserInterface
{
    /** @var JsonValidatorInterface $jsonValidator */
    protected $jsonCoordinatesValidator;

    /**
     * @param JsonValidatorInterface $jsonCoordinatesValidator
     */
    public function __construct(JsonValidatorInterface $jsonCoordinatesValidator)
    {
        $this->jsonCoordinatesValidator = $jsonCoordinatesValidator;
    }

    /**
     * @param \StdClass $coordinatesObject
     * @return Coordinates
     */
    public function parse($coordinatesObject)
    {
        $coordinates = new Coordinates();

        if ($this->jsonCoordinatesValidator->validate($coordinatesObject)) {
            $coordinates->setLatitude($coordinatesObject->lat);
            $coordinates->setLongitude($coordinatesObject->long);
        }

        return $coordinates;
    }
}