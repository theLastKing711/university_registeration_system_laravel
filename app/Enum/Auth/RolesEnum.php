<?php

namespace App\Enum\Auth;

enum RolesEnum: string
{
    // case NAMEINAPP = 'name-in-database';

    case ADMIN = 'admin';

    case STUDENT = 'student';

    case COURSES_REGISTERER = 'courses registerer';

    case MARKS_ASSIGNER = 'marks assigner';

    public function label(): string
    {

        return match ($this) {
            self::ADMIN => 'Admin',
            self::STUDENT => 'Student',
            self::COURSES_REGISTERER => 'Course Cegisterer',
            self::MARKS_ASSIGNER => 'Marks Assigner',
        };
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @return PermissionsEnum[]
     **/
    public function permissions(): array
    {

        return match ($this) {
            self::ADMIN => [
                ...PermissionsEnum::get_academic_year_semesters_permissions(),
                ...PermissionsEnum::get_admin_permissions(),
                ...PermissionsEnum::get_classroom_course_teachers_permissions(),
                ...PermissionsEnum::get_classrooms_permissions(),
                ...PermissionsEnum::get_courses(),
                ...PermissionsEnum::get_exams(),
                ...PermissionsEnum::get_departments(),
                ...PermissionsEnum::get_lectures(),
                ...PermissionsEnum::get_open_course_registerations_permissions(),
                ...PermissionsEnum::get_students(),
                ...PermissionsEnum::get_teachers(),
            ],
            self::STUDENT => PermissionsEnum::get_open_course_registerations_permissions(),
            self::COURSES_REGISTERER => PermissionsEnum::get_open_course_registerations_permissions(),
            self::MARKS_ASSIGNER => PermissionsEnum::get_open_course_registerations_permissions(),
        };
    }

    /**
     * Summary of oneOfMiddleware
     *
     * @param  RolesEnum[]  $roles
     */
    public static function oneOfRolesMiddleware(...$roles): string
    {
        $roles_count = count($roles);

        $roles_collections = collect($roles);

        return $roles_collections->reduce(function ($prev, $current, $index) {

            if ($index === 0) {
                return $prev.$current->value;
            }

            return $prev.'|'.$current->value;

        }, 'role:');

    }

    public static function oneRoleOnlyMiddleware(RolesEnum $role): string
    {
        return 'role:'.$role->value;
    }
}
