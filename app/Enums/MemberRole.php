<?php

namespace App\Enums;

enum MemberRole: string
{
    case ADMIN = 'admin';
    case MODERATOR = 'moderator';
    case GUEST = 'guest';
}
