<?php

namespace App\Catalogs;

enum Status: int
{
    case CANCELED = 0;
    case ACTIVE = 1;
    case SUSPENDED = 2;
}
