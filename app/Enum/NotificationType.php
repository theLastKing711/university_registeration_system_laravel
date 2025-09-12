<?php

namespace App\Enum;

use App\Trait\EnumHelper;
use OpenApi\Attributes as OAT;

#[OAT\Schema()]
enum NotificationType: string
{
    case AdminCreated = 'admin-created';

    case TeacherAssignedToCourse = 'teacher-assigned-to-course';

    use EnumHelper;
}
