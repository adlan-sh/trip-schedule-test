<?php

declare(strict_types=1);

namespace App\Controller\Region;

use App\Service\RegionService;
use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Controller\ControllerInterface;

readonly class Regions implements ControllerInterface
{
    public function __construct(
        private RegionService $regionService,
        private Engine $plates,
    ) {}

    public function execute(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $regions = $this->regionService->getAllRegions();

        return new Response(
            200,
            [],
            $this->plates->render('region', [
                'regions' => $regions
            ])
        );
    }
}
