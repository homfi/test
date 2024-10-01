<?php

namespace App\Enums;

use App\Enums\Traits\ProvidesValues;

enum OrderStatus
{
    use ProvidesValues;

    case CREATED;
    case PAID;
    case ACCEPTED;
    case REJECTED;
}
