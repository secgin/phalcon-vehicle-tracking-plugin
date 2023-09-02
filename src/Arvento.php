<?php

namespace YG\VehicleTracking;

use Phalcon\Di\Injectable;
use YG\Arvento\ArventoInterface;

class Arvento extends Injectable implements VehicleTrackingInterface
{
    private ArventoInterface $arvento;

    public function __construct()
    {
        $this->arvento = new \YG\Arvento\Arvento(
            $this->config->arvento->host,
            $this->config->arvento->username,
            $this->config->arvento->pin1,
            $this->config->arvento->pin2);
    }

    public function getLocation(string $licensePlate): ?Location
    {
        $node = $this->arvento->getNodeFromLicensePlate($licensePlate);
        if (!$node)
            return null;

        $result = $this->arvento->getVehicleStatusByNodeV3($node);
        if (!$result)
            return null;

        $location = new Location();
        $location->lat = $result->dLatitude;
        $location->lon = $result->dLongitude;
        $location->speed = $result->dSpeed;

        return $location;
    }
}