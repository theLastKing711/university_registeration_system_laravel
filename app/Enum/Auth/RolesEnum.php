<?php

namespace App\Enum\Auth;

enum RolesEnum: string
{
    // case NAMEINAPP = 'name-in-database';

    case ADMIN = 'admin';

    case STUDENT = 'student';

    case COURSES_REGISTERER = 'courses registerer';

    case MARKS_ASSIGNER = 'marks assigner';

    // case DRIVER = 'driver';

    // case STORE = 'store';

    // extra helper to allow for greater customization of displayed values,
    // without disclosing the name/value data directly
    // can be used like this: RolesEnum::ADMIN->label() which return 'Admin'
    public function label(): string
    {

        return match ($this) {
            self::ADMIN => 'Admin',
            self::STUDENT => 'Student',
            self::COURSES_REGISTERER => 'Course Cegisterer',
            self::MARKS_ASSIGNER => 'Marks Assigner',
            // self::USER => 'User',
            // self::DRIVER => 'Driver',
            // self::STORE => 'Store',
        };
    }
}
