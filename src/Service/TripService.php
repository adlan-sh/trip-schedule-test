<?php

declare(strict_types = 1);

namespace App\Service;

use App\Repository\TripRepository;

readonly class TripService
{
    public function __construct(private TripRepository $tripRepository)
    {
    }

    public function getAllTrips(?string $startDate, ?string $endDate): array
    {
        return $this->tripRepository->getAll($startDate, $endDate);
    }

    public function addNewTrip(string $regionId, string $courierId, string $startDate, string $endDate): void
    {
        $this->tripRepository->add(
            (int) $regionId,
            (int) $courierId,
            $startDate,
            $endDate
        );
    }
}
