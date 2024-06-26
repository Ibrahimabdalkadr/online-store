<?php

namespace App\Enums;

enum TicketStatusEnum: int
{
    use BaseEnum;
    case pending = 0;
    case active = 1;
    case closed = 2;

}
