<?php

declare(strict_types = 1);

namespace App\Repository;

use App\Model\Trip;
use PDO;

readonly class TripRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    /**
     * @return Trip[]
     */
    public function getAll(?string $startDate, ?string $endDate): array
    {
        $startDate = $startDate === "" ? null : $startDate;
        $endDate = $endDate === "" ? null : $endDate;
        $sql = 'SELECT trips.id, trips.startDate, trips.endDate, couriers.firstname, couriers.lastname, couriers.middlename, regions.name 
                FROM trips LEFT JOIN couriers ON couriers.id = trips.courierid LEFT JOIN regions on regions.id = trips.regionid';

        if ($startDate !== null && $endDate !== null) {
            $startDate = (new \DateTimeImmutable($startDate))->format('Y-m-d');
            $endDate = (new \DateTimeImmutable($endDate))->format('Y-m-d');
            $sql .= ' WHERE trips.startdate >= \'' . $startDate . '\' AND trips.enddate <= \'' . $endDate . '\'';
        } elseif ($startDate !== null) {
            $startDate = (new \DateTimeImmutable($startDate))->format('Y-m-d');
            $sql .= ' WHERE trips.startdate >= \'' . $startDate . '\'';
        } elseif ($endDate !== null) {
            $endDate = (new \DateTimeImmutable($endDate))->format('Y-m-d');
            $sql .= ' WHERE trips.enddate <= \'' . $endDate . '\'';
        }

        $sth = $this->pdo->query($sql);

        return $sth->fetchAll(PDO::FETCH_OBJ);
    }

    public function add(int $regionId, int $courierId, string $startDate, string $endDate): void
    {
        $sth = $this->pdo->prepare('INSERT INTO trips (regionid, courierid, startdate, enddate) VALUES (:regionid, :courierid, :startdate, :enddate)');
        $startDate = (new \DateTimeImmutable($startDate))->format('Y-m-d');
        $endDate = (new \DateTimeImmutable($endDate))->format('Y-m-d');
        $sth->bindParam(':regionid', $regionId, PDO::PARAM_INT);
        $sth->bindParam(':courierid', $courierId, PDO::PARAM_INT);
        $sth->bindParam(':startdate',$startDate);
        $sth->bindParam(':enddate', $endDate);

        $sth->execute();
    }
}
