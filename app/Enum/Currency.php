<?php

namespace App\Enum;

use App\Trait\EnumHelper;
use OpenApi\Attributes as OAT;

#[OAT\Schema]
enum Currency: string
{
    case USD = 'USD';
    case SYP = 'SYP';

    use EnumHelper;
}
