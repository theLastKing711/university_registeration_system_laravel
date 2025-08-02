<?php

namespace App\Enum;

enum FileUploadDirectory: string
{
    case USER_PROFILE_PICTURE = 'profile_picture';

    case SCHOOL_FILES = 'school_files';

    // case DRIVER = 'driver';

    // case STORE = 'store';

    // extra helper to allow for greater customization of displayed values,
    // without disclosing the name/value data directly
    // can be used like this: RolesEnum::ADMIN->label() which return 'Admin'
    public function label(): string
    {

        return match ($this) {
            self::USER_PROFILE_PICTURE => 'User Profile Picture',
            self::SCHOOL_FILES => 'School Files',
        };
    }
}
