<?php

declare(strict_types = 1);

namespace App\Service;

use App\Repository\RegionRepository;

readonly class RegionService
{
    public function __construct(private RegionRepository $regionRepository)
    {
    }

    public function getAllRegions(): array
    {
        return $this->regionRepository->getAll();
    }
}
