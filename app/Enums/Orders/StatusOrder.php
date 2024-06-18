<?php

namespace App\Enums\Orders;

enum StatusOrder: string
{
    case DONE = "D";
    case CANCELED = "C";
    case ENCERRED = "E";
}
