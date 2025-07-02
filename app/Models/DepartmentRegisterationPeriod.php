<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property int $id
 * @property int $department_id
 * @property int $academic_year_semester_id
 * @property int $is_open_for_students
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \App\Models\AcademicYearSemester|null $academicSemesterYear
 * @property-read \App\Models\Department $department
 *
 * @method static Illuminate\Database\Eloquent\Builder<static> joinRelationship(string $relations, \Closure(Illuminate\Database\Query\JoinClause $join)|array $join_callback_or_array)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DepartmentRegisterationPeriod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DepartmentRegisterationPeriod newQuery()
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DepartmentRegisterationPeriod query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DepartmentRegisterationPeriod whereAcademicYearSemesterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DepartmentRegisterationPeriod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DepartmentRegisterationPeriod whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DepartmentRegisterationPeriod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DepartmentRegisterationPeriod whereIsOpenForStudents($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DepartmentRegisterationPeriod whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class DepartmentRegisterationPeriod extends Pivot
{
    /** @use HasFactory<\Database\Factories\DepartmentRegisterationPeriod> */
    use HasFactory;

    public $incrementing = true;

    protected $table = 'department_registeration_periods';

    /**
     * Summary of department
     *
     * @return BelongsTo<Department, $this>
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Summary of academicSemesterYear
     *
     * @return BelongsTo<AcademicYearSemester, $this>
     */
    public function academicSemesterYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYearSemester::class);
    }
}
