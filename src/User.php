<?php

namespace App;

class User
{
    public bool $isSubcribed = false;

    public function __construct(protected string $name, protected string $age)
    {
    }
}
