<?php

declare(strict_types=1);

namespace App\Controller\API;

use App\Service\RegionService;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Controller\ControllerInterface;

readonly class Regions implements ControllerInterface
{
    public function __construct(
        private RegionService $regionService,
    ) {}

    public function execute(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $regions = $this->regionService->getAllRegions();

        return new Response(
            200,
            [],
            json_encode($regions, JSON_THROW_ON_ERROR)
        );
    }
}
