<?php

namespace App\Enums;

enum EventStatus: string
{
    case OPEN = 'registration available';
    case CLOSE = 'registration unavailable';
}
