<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property int $id
 * @property int $classroom_id
 * @property int $course_teacher_id
 * @property int $day
 * @property string $from
 * @property string $to
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Classroom $classroom
 * @property-read \App\Models\CourseTeacher $courseTeacher
 *
 * @method static \Database\Factories\ClassroomCourseTeacherFactory factory($count = null, $state = [])
 * @method static Illuminate\Database\Eloquent\Builder<static> joinRelationship(string $relations, \Closure(Illuminate\Database\Query\JoinClause $join)|array $join_callback_or_array)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassroomCourseTeacher newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassroomCourseTeacher newQuery()
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassroomCourseTeacher query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassroomCourseTeacher whereClassroomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassroomCourseTeacher whereCourseTeacherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassroomCourseTeacher whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassroomCourseTeacher whereDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassroomCourseTeacher whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassroomCourseTeacher whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassroomCourseTeacher whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassroomCourseTeacher whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class ClassroomCourseTeacher extends Pivot
{
    /** @use HasFactory<\Database\Factories\ClassroomCourseTeacherFactory> */
    use HasFactory;

    public $incrementing = true;

    /**
     * Summary of classroom
     *
     * @return BelongsTo<Classroom, $this>
     */
    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }

    /**
     * Summary of courseTeacher
     *
     * @return BelongsTo<CourseTeacher, $this>
     */
    public function courseTeacher(): BelongsTo
    {
        return $this->belongsTo(CourseTeacher::class, 'course_teacher_id');
    }
}
