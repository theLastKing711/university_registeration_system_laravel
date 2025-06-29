<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * 
 *
 * @property int $id
 * @property int $course_id
 * @property int $academic_year_semester_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \App\Models\AcademicYearSemester $academicYearSemester
 * @property-read \App\Models\Course $course
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CourseTeacher> $courseTeachers
 * @property-read int|null $course_teachers_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StudentCourseRegisteration> $studentCourseRegisterations
 * @property-read int|null $student_course_registerations_count
 * @property-read \App\Data\Shared\ModelwithPivotCollection<\App\Models\User,\Illuminate\Database\Eloquent\Relations\Pivot> $students
 * @property-read int|null $students_count
 * @property-read \App\Data\Shared\ModelwithPivotCollection<\App\Models\Teacher,\Illuminate\Database\Eloquent\Relations\Pivot> $teachers
 * @property-read int|null $teachers_count
 * @method static \Database\Factories\OpenCourseRegisterationFactory factory($count = null, $state = [])
 * @method static Illuminate\Database\Eloquent\Builder<static> joinRelationship(string $relations, \Closure(Illuminate\Database\Query\JoinClause $join)|array $join_callback_or_array)
 * @method static Builder<static>|OpenCourseRegisteration newModelQuery()
 * @method static Builder<static>|OpenCourseRegisteration newQuery()
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
 * @method static Builder<static>|OpenCourseRegisteration query()
 * @method static Builder<static>|OpenCourseRegisteration whereAcademicYearSemesterId($value)
 * @method static Builder<static>|OpenCourseRegisteration whereCourseId($value)
 * @method static Builder<static>|OpenCourseRegisteration whereCreatedAt($value)
 * @method static Builder<static>|OpenCourseRegisteration whereId($value)
 * @method static Builder<static>|OpenCourseRegisteration whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OpenCourseRegisteration extends Pivot
{
    /** @use HasFactory<\Database\Factories\OpenCourseRegisterationFactory> */
    use HasFactory;

    public $incrementing = true;

    protected $table = 'open_course_registerations';

    /**
     * Get the course that owns the openCourseRegisteration
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get the academicYearSemester that owns the OpenCourseRegisteration
     */
    public function academicYearSemester(): BelongsTo
    {
        return $this->belongsTo(AcademicYearSemester::class);
    }

    /**
     * The teachers that belong to the openCourseRegisteration
     */
    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(
            Teacher::class,
            'course_teacher',
            'course_id'
        );
    }

    /**
     * Get all of the CourseTeachers for the openCourseRegisteration
     */
    public function courseTeachers(): HasMany
    {
        return $this->hasMany(
            CourseTeacher::class,
            'course_id',
            'id'
        );
    }

    /**
     * Get the students that owns the openCourseRegisteration
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'student_course_registerations',
            'course_id',
            'student_id'
        );
    }

    /**
     * Get all of the studentCourseRegisterations for the openCourseRegisteration
     */
    public function studentCourseRegisterations(): HasMany
    {
        return $this->hasMany(
            StudentCourseRegisteration::class,
            'course_id'
        );
    }

    #[Scope]
    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     **/
    protected function getStudents(Builder $query, int $id): void
    {
        $query->where('votes', '>', 100);
    }
}
