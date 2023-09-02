<?php

namespace YG\VehicleTracking;

use Phalcon\Di\Injectable;
use YG\TrioMobil\TrioMobilInterface;

class TrioMobil extends Injectable implements VehicleTrackingInterface
{
    private TrioMobilInterface $trioMobil;

    public function __construct()
    {
        $this->trioMobil = new \YG\TrioMobil\TrioMobil(
            $this->config->trioMobil->host,
            $this->config->trioMobil->username,
            $this->config->trioMobil->password);
    }

    public function getLocation(string $licensePlate): ?Location
    {
        $result = $this->trioMobil->getLocation($licensePlate);
        if (!$result)
            return null;

        $location = new Location();
        $location->lat = $result->lat;
        $location->lon = $result->lon;
        $location->speed = $result->spd;

        return $location;
    }
}