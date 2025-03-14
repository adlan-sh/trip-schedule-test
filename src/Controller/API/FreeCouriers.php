<?php

declare(strict_types=1);

namespace App\Controller\API;

use App\Service\CourierService;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Controller\ControllerInterface;

readonly class FreeCouriers implements ControllerInterface
{
    public function __construct(
        private CourierService $courierService,
    ) {}

    public function execute(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $query = $request->getQueryParams();
        $startDate = $query['startDate'];
        $endDate = $query['endDate'];
        $couriers = $this->courierService->getFreeCouriers($startDate, $endDate);

        return new Response(
            200,
            [],
            json_encode($couriers, JSON_THROW_ON_ERROR)
        );
    }
}
