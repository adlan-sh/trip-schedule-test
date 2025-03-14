<?php

declare(strict_types = 1);

namespace App\Repository;

use App\Model\Region;
use PDO;

readonly class RegionRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    /**
     * @return Region[]
     */
    public function getAll(): array
    {
        $sth = $this->pdo->query('SELECT * FROM regions');

        return $sth->fetchAll(PDO::FETCH_CLASS, Region::class);
    }
}
