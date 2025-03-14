<?php

declare(strict_types=1);

namespace App\Controller\Courier;

use App\Service\CourierService;
use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Controller\ControllerInterface;

readonly class Couriers implements ControllerInterface
{
    public function __construct(
        private CourierService $courierService,
        private Engine $plates,
    ) {}

    public function execute(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $couriers = $this->courierService->getAllCouriers();

        return new Response(
            200,
            [],
            $this->plates->render('courier', [
                'couriers' => $couriers
            ])
        );
    }
}
