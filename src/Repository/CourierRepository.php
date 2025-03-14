<?php

declare(strict_types = 1);

namespace App\Repository;

use App\Model\Courier;
use PDO;

readonly class CourierRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    /**
     * @return Courier[]
     */
    public function getAll(): array
    {
        $sth = $this->pdo->query('SELECT * FROM couriers');

        return $sth->fetchAll(PDO::FETCH_CLASS, Courier::class);
    }

    public function getFree(string $startDate, string $endDate): array
    {
        $sth = $this->pdo->prepare(
        'SELECT couriers.id, couriers.firstname, couriers.lastname, couriers.middlename FROM couriers 
            LEFT JOIN trips ON couriers.id = trips.courierid WHERE 
            NOT (TO_DATE(:startdate, \'DD.MM.YYYY\') BETWEEN trips.startdate AND trips.enddate 
            OR TO_DATE(:enddate, \'DD.MM.YYYY\') BETWEEN trips.startdate AND trips.enddate) 
            OR couriers.id NOT IN (SELECT courierid FROM trips)');
        $sth->bindValue(':startdate', $startDate);
        $sth->bindValue(':enddate', $endDate);
        $sth->execute();

        return $sth->fetchAll(PDO::FETCH_CLASS, Courier::class);
    }
}
