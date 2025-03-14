<?php

declare(strict_types = 1);

namespace App\Model;

use DateTimeImmutable;

class Trip
{
    public int $id;

    public DateTimeImmutable $startdate;

    public int $courierid;

    public DateTimeImmutable $enddate;
}
