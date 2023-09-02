<?php

namespace YG\VehicleTracking;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;

class VehicleTrackingProvider implements ServiceProviderInterface
{
    public function register(DiInterface $di)
    {
        $company = $di->get('config')->get('vehicleTrackingCompany');

        $di->setShared('vehicleTracking', function() use ($company) {
            if ($company == 'trio_mobil')
                return new TrioMobil();

            return new Arvento();
        });
    }
}