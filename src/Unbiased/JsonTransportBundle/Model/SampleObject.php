<?php

namespace Unbiased\JsonTransportBundle\Model;

class SampleObject
{
    /**
     * @var array
     */
    protected $locations;

    /**
     * @return array
     */
    public function getLocations()
    {
        return $this->locations;
    }

    /**
     * @param array $locations
     */
    public function setLocations($locations)
    {
        $this->locations = $locations;
    }

    /**
     * @param Location $location
     *
     * @return Location
     */
    public function addLocation(Location $location)
    {
        $this->locations[] = $location;

        return $this;
    }

    /**
     * @param Location $location
     *
     * @return Location
     */
    public function removeLocation(Location $location)
    {
        if (false !== ($key = array_search($location, $this->locations, true))) {
            unset($this->locations[$key]);
        }

        return $this;
    }
}