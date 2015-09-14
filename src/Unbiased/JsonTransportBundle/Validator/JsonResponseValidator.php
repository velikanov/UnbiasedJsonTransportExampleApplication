<?php

namespace Unbiased\JsonTransportBundle\Validator;

use Unbiased\JsonTransportBundle\Exception\Transport\MalformedJsonResponseException;
use Unbiased\JsonTransportBundle\Exception\Transport\UnsuccessfulJsonResponseException;

class JsonResponseValidator implements JsonValidatorInterface
{
    /**
     * @param \stdClass $jsonLocationObject
     * @return bool
     * @throws MalformedJsonResponseException
     * @throws UnsuccessfulJsonResponseException
     */
    public function validate($jsonLocationObject)
    {
        if (!property_exists($jsonLocationObject, 'success')) {
            throw new MalformedJsonResponseException('JSON response doesn\'t contain `success` part');
        }

        if (true !== $jsonLocationObject->success) {
            if (
                property_exists($jsonLocationObject, 'data')
                &&
                property_exists($jsonLocationObject->data, 'message')
                &&
                property_exists($jsonLocationObject->data, 'code')
            ) {
                throw new UnsuccessfulJsonResponseException(
                    $jsonLocationObject->data->message,
                    $jsonLocationObject->data->code
                );
            }

            throw new MalformedJsonResponseException('JSON response doesn\'t contain proper error message');
        }

        if (
            !property_exists($jsonLocationObject, 'data')
            ||
            (
                property_exists($jsonLocationObject, 'data')
                &&
                !property_exists($jsonLocationObject->data, 'locations')
            )
        ) {
            throw new MalformedJsonResponseException('JSON object doesn\'t contain Locations information');
        }

        if (
            property_exists($jsonLocationObject->data, 'locations')
            &&
            !is_array($jsonLocationObject->data->locations)
        ) {
            throw new MalformedJsonResponseException('JSON object contains malformed Locations data');
        }

        return true;
    }
}