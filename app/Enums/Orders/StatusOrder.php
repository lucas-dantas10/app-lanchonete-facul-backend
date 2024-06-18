<?php

namespace App\Enums\Orders;

enum StatusOrder: string
{
    case FINALIZED = "F";
    case CANCELED = "C";
}
