<?php

namespace App\Enums\Orders;

enum StatusOrder: string
{
    case PAID = "P";
    case NOT_PAID = "NP";
}
