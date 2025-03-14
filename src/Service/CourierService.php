<?php

declare(strict_types = 1);

namespace App\Service;

use App\Repository\CourierRepository;

readonly class CourierService
{
    public function __construct(private CourierRepository $courierRepository)
    {
    }

    public function getAllCouriers(): array
    {
        return $this->courierRepository->getAll();
    }

    public function getFreeCouriers(string $startDate, string $endDate): array
    {
        return $this->courierRepository->getFree($startDate, $endDate);
    }
}
