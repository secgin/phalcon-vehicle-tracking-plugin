<?php

namespace YG\VehicleTracking;

interface VehicleTrackingInterface
{
    public function getLocation(string $licensePlate): ?Location;
}