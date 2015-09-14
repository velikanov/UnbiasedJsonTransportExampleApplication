<?php

namespace Unbiased\JsonTransportBundle\Model;

class Location
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var Coordinates
     */
    protected $coordinates;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Location
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Coordinates
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }

    /**
     * @param Coordinates $coordinates
     *
     * @return Location
     */
    public function setCoordinates($coordinates)
    {
        $this->coordinates = $coordinates;

        return $this;
    }
}