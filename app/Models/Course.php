<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int|null $department_id
 * @property string $name
 * @property string $code
 * @property int $is_active
 * @property int $credits
 * @property int $open_for_students_in_year
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CrossListedCourses> $SecondCrossListedCourses
 * @property-read int|null $second_cross_listed_courses_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CourseTeacher> $courseTeachers
 * @property-read int|null $course_teachers_count
 * @property-read \App\Data\Shared\ModelwithPivotCollection<\App\Models\Course,\Illuminate\Database\Eloquent\Relations\Pivot> $coursesPrerequisites
 * @property-read int|null $courses_prerequisites_count
 * @property-read \App\Models\Department|null $department
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CrossListedCourses> $firstCrossListedCourses
 * @property-read int|null $first_cross_listed_courses_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OpenCourseRegisteration> $openCourseRegisterations
 * @property-read int|null $open_course_registerations_count
 * @property-read \App\Data\Shared\ModelwithPivotCollection<\App\Models\AcademicYearSemester,\Illuminate\Database\Eloquent\Relations\Pivot> $openedYearsSemesters
 * @property-read int|null $opened_years_semesters_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Prerequisite> $prerequisites
 * @property-read int|null $prerequisites_count
 * @property-read \App\Data\Shared\ModelwithPivotCollection<\App\Models\Teacher,\Illuminate\Database\Eloquent\Relations\Pivot> $teachers
 * @property-read int|null $teachers_count
 *
 * @method static \Database\Factories\CourseFactory factory($count = null, $state = [])
 * @method static Illuminate\Database\Eloquent\Builder<static> joinRelationship(string $relations, \Closure(Illuminate\Database\Query\JoinClause $join)|array $join_callback_or_array)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course newQuery()
 * @method static Illuminate\Database\Eloquent\Builder<static> orderByLeftPowerJoins(string|array<string, \Illuminate\Contracts\Database\Query\Expression> $column)
 * @method static Illuminate\Database\Eloquent\Builder<static> orderByLeftPowerJoinsCount(string $column, string|null $order)
 * @method static Illuminate\Database\Eloquent\Builder<static> orderByPowerJoins(string|array<string, \Illuminate\Contracts\Database\Query\Expression> $column)
 * @method static Illuminate\Database\Eloquent\Builder<static> orderByPowerJoinsAvg(string $column, string|null $order)
 * @method static Illuminate\Database\Eloquent\Builder<static> orderByPowerJoinsCount(string $column, string|null $order)
 * @method static Illuminate\Database\Eloquent\Builder<static> orderByPowerJoinsMax(string $column, string|null $order)
 * @method static Illuminate\Database\Eloquent\Builder<static> orderByPowerJoinsMin(string $column, string|null $order)
 * @method static Illuminate\Database\Eloquent\Builder<static> orderByPowerJoinsSum(string $column, string|null $order)
 * @method static Illuminate\Database\Eloquent\Builder<static> orderByPowerLeftJoinsAvg(string $column, string|null $order)
 * @method static Illuminate\Database\Eloquent\Builder<static> orderByPowerLeftJoinsMax(string $column, string|null $order)
 * @method static Illuminate\Database\Eloquent\Builder<static> orderByPowerLeftJoinsMin(string $column, string|null $order)
 * @method static Illuminate\Database\Eloquent\Builder<static> orderByPowerLeftJoinsSum(string $column, string|null $order)
 * @method static Illuminate\Database\Eloquent\Builder<static> powerJoinHas(string $relations, mixed operater, mixed value)
 * @method static Illuminate\Database\Eloquent\Builder<static> powerJoinWhereHas(string $relations, \Closure(Illuminate\Database\Query\JoinClause $join)|array $join_callback_or_array)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereCredits($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereOpenForStudentsInYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Course extends Model
{
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory;

    /**
     * Get the department that owns the Course
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get all of the prerequisites for the Course
     */
    public function prerequisites(): HasMany
    {
        return $this->hasMany(Prerequisite::class);
    }

    /**
     * The courses that belong to the prerequisite
     */
    public function coursesPrerequisites(): BelongsToMany
    {
        return $this->belongsToMany(
            Course::class,
            'prerequisites',
            'course_id',
            'prerequisite_id'
        );
    }

    /**
     * The academicYearOpenedInt that belong to the Course
     */
    public function openedYearsSemesters(): BelongsToMany
    {
        return $this->belongsToMany(AcademicYearSemester::class, 'open_course_registerations');
    }

    /**
     * Get all of the openCourseRegisterations for the Course
     */
    public function openCourseRegisterations(): HasMany
    {
        return $this->hasMany(openCourseRegisteration::class);
    }

    /**
     * Get all of the firstCrossListedCourses for the Course
     */
    public function firstCrossListedCourses(): HasMany
    {
        return $this->hasMany(CrossListedCourses::class, 'first_course_id');
    }

    /**
     * Get all of the firstCrossListedCourses for the Course
     */
    public function firstCrossListed(): BelongsToMany
    {
        return $this
            ->belongsToMany(
                Course::class,
                'cross_listed_courses',
                'first_course_id',
                'second_course_id'
            );
    }

    /**
     * Get all of the SecondCrossListedCourses for the Course
     */
    public function SecondCrossListedCourses(): HasMany
    {
        return $this->hasMany(CrossListedCourses::class, 'second_course_id');
    }

    /**
     * Get all of the secondCrossListedCourses for the Course
     */
    public function secondCrossListed(): BelongsToMany
    {
        return $this
            ->belongsToMany(
                Course::class,
                'cross_listed_courses',
                'second_course_id',
                'first_course_id'
            );
    }
}
