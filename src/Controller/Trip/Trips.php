<?php

declare(strict_types=1);

namespace App\Controller\Trip;

use App\Service\TripService;
use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Controller\ControllerInterface;

readonly class Trips implements ControllerInterface
{
    public function __construct(
        private TripService $tripService,
        private Engine $plates,
    ) {}

    public function execute(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $query = $request->getQueryParams();
        $startDate = $query['startDateFilter'] ?? null;
        $endDate = $query['endDateFilter'] ?? null;
        $trips = $this->tripService->getAllTrips($startDate, $endDate);

        return new Response(
            200,
            [],
            $this->plates->render('trip', [
                'trips' => $trips
            ])
        );
    }
}
