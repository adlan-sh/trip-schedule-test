<?php

declare(strict_types=1);

namespace App\Config;

use App\Controller;
use App\Controller\Admin;

class Route
{
    public const COURIER = '/courier';
    public const REGION = '/region';
    public const SCHEDULE = '/schedule';
    public const ADD_SCHEDULE = '/schedule/add';

    public static function getRoutes(): array
    {
        return [
            ['GET', '/courier', Controller\Courier\Couriers::class],
            ['GET', '/region', Controller\Region\Regions::class],
            ['GET', '/schedule', Controller\Trip\Trips::class],
            ['GET', '/api/region', Controller\API\Regions::class],
            ['GET', '/api/courier', Controller\API\Couriers::class],
            ['GET', '/api/courier/free', Controller\API\FreeCouriers::class],
            ['POST', '/api/courier/add', Controller\API\AddTrip::class],
            [ 'GET', '/', Controller\Home::class ],
        ];
    }
}
