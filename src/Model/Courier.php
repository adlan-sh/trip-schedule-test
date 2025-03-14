<?php

declare(strict_types = 1);

namespace App\Model;

class Courier
{
    public int $id;

    public string $firstname;

    public string $lastname;

    public ?string $middlename;
}
