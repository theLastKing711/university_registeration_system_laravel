<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property int $id
 * @property int $lecture_id
 * @property int $student_id
 * @property int $is_student_present
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Lecture $lecture
 * @property-read \App\Models\User $student
 *
 * @method static \Database\Factories\CourseAttendanceFactory factory($count = null, $state = [])
 * @method static Illuminate\Database\Eloquent\Builder<static> joinRelationship(string $relations, \Closure(Illuminate\Database\Query\JoinClause $join)|array $join_callback_or_array)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseAttendance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseAttendance newQuery()
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseAttendance query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseAttendance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseAttendance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseAttendance whereIsStudentPresent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseAttendance whereLectureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseAttendance whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseAttendance whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class CourseAttendance extends Pivot
{
    /** @use HasFactory<\Database\Factories\CourseAttendanceFactory> */
    use HasFactory;

    public $incrementing = true;

    /**
     * Get the student that owns the CourseAttendance
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'student_id',
        );
    }

    /**
     * Get the courseTeacher that owns the CourseAttendance
     */
    public function lecture(): BelongsTo
    {
        return $this->belongsTo(
            Lecture::class,
        );
    }
}
