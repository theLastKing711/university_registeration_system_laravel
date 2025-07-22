<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property int $id
 * @property int $student_id
 * @property int $course_id
 * @property int|null $final_mark
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\OpenCourseRegisteration $course
 * @property-read \App\Models\User $student
 *
 * @method static Illuminate\Database\Eloquent\Builder<static> joinRelationship(string $relations, \Closure(Illuminate\Database\Query\JoinClause $join)|array $join_callback_or_array)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StudentCourseRegisteration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StudentCourseRegisteration newQuery()
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StudentCourseRegisteration query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StudentCourseRegisteration whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StudentCourseRegisteration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StudentCourseRegisteration whereFinalMark($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StudentCourseRegisteration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StudentCourseRegisteration whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StudentCourseRegisteration whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class StudentCourseRegisteration extends Pivot
{
    protected $table = 'student_course_registerations';

    public $incrementing = true;

    /**
     * Summary of student
     *
     * @return BelongsTo<User, $this>
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * Summary of course
     *
     * @return BelongsTo<OpenCourseRegisteration, $this>
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(OpenCourseRegisteration::class, 'course_id');
    }
}
