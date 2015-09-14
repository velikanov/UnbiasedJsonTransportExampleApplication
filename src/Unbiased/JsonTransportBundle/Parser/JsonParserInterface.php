<?php

namespace Unbiased\JsonTransportBundle\Parser;

interface JsonParserInterface
{
    /**
     * @param $object
     * @return mixed
     */
    public function parse($object);
}