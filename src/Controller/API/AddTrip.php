<?php

declare(strict_types=1);

namespace App\Controller\API;

use App\Service\TripService;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Controller\ControllerInterface;

readonly class AddTrip implements ControllerInterface
{
    public function __construct(
        private TripService $tripService,
    ) {}

    public function execute(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $query = $request->getQueryParams();
        $region = $query['region'];
        $startDate = $query['startDate'];
        $endDate = $query['endDate'];
        $courier = $query['courier'];

        $this->tripService->addNewTrip($region, $courier, $startDate, $endDate);

        return new Response(
            200,
            []
        );
    }
}
