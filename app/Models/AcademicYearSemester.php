<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $year
 * @property int $semester
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Data\Shared\ModelwithPivotCollection<\App\Models\Course,\Illuminate\Database\Eloquent\Relations\Pivot> $courses
 * @property-read int|null $courses_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DepartmentRegisterationPeriod> $departmentRegisterationPeriod
 * @property-read int|null $department_registeration_period_count
 * @property-read \App\Data\Shared\ModelwithPivotCollection<\App\Models\Department,\Illuminate\Database\Eloquent\Relations\Pivot> $departments
 * @property-read int|null $departments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OpenCourseRegisteration> $openCourseRegisterations
 * @property-read int|null $open_course_registerations_count
 *
 * @method static \Database\Factories\AcademicYearSemesterFactory factory($count = null, $state = [])
 * @method static Illuminate\Database\Eloquent\Builder<static> joinRelationship(string $relations, \Closure(Illuminate\Database\Query\JoinClause $join)|array $join_callback_or_array)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AcademicYearSemester newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AcademicYearSemester newQuery()
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AcademicYearSemester query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AcademicYearSemester whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AcademicYearSemester whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AcademicYearSemester whereSemester($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AcademicYearSemester whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AcademicYearSemester whereYear($value)
 *
 * @mixin \Eloquent
 */
class AcademicYearSemester extends Model
{
    /** @use HasFactory<\Database\Factories\AcademicYearSemesterFactory> */
    use HasFactory;

    /**
     * Summary of departmentRegisterationPeriod
     *
     * @return HasMany<DepartmentRegisterationPeriod, $this>
     */
    public function departmentRegisterationPeriod(): HasMany
    {
        return $this->hasMany(DepartmentRegisterationPeriod::class);
    }

    /**
     * Summary of departments
     *
     * @return BelongsToMany<Department, $this, \Illuminate\Database\Eloquent\Relations\Pivot>
     */
    public function departments(): BelongsToMany
    {
        return $this->belongsToMany(Department::class, 'department_registeration_periods');
    }

    /**
     * Summary of openCourseRegisterations
     *
     * @return HasMany<OpenCourseRegisteration, $this>
     */
    public function openCourseRegisterations(): HasMany
    {
        return $this->hasMany(OpenCourseRegisteration::class);
    }

    /**
     * Summary of courses
     *
     * @return BelongsToMany<Course, $this, \Illuminate\Database\Eloquent\Relations\Pivot>
     */
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'open_course_registerations');
    }
}
