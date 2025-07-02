<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $course_teacher_id
 * @property string $happened_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CourseAttendance> $attendances
 * @property-read int|null $attendances_count
 * @property-read \App\Models\CourseTeacher $courseTeacher
 * @property-read \App\Data\Shared\ModelwithPivotCollection<\App\Models\User,\Illuminate\Database\Eloquent\Relations\Pivot> $students
 * @property-read int|null $students_count
 *
 * @method static \Database\Factories\LectureFactory factory($count = null, $state = [])
 * @method static Illuminate\Database\Eloquent\Builder<static> joinRelationship(string $relations, \Closure(Illuminate\Database\Query\JoinClause $join)|array $join_callback_or_array)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lecture newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lecture newQuery()
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lecture query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lecture whereCourseTeacherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lecture whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lecture whereHappenedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lecture whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lecture whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Lecture extends Model
{
    /** @use HasFactory<\Database\Factories\LectureFactory> */
    use HasFactory;

    /**
     * Get the courseTeacher that owns the Lecture
     */
    public function courseTeacher(): BelongsTo
    {
        return $this->belongsTo(
            CourseTeacher::class,
            'course_teacher_id'
        );
    }

    /**
     * Get all of the courseAttendances for the Lecture
     */
    public function attendances(): HasMany
    {
        return $this->hasMany(CourseAttendance::class);
    }

    /**
     * The students that belong to the Lecture
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'course_attendance',
            'lecture_id',
            'student_id'
        );
    }
}
