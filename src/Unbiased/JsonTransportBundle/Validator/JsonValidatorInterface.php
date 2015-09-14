<?php

namespace Unbiased\JsonTransportBundle\Validator;

interface JsonValidatorInterface
{
    /**
     * @param \stdClass $jsonLocationObject
     * @return bool
     */
    public function validate($jsonLocationObject);
}