<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property int $id
 * @property int $course_teacher_id
 * @property int $classroom_id
 * @property int $max_mark
 * @property string $date
 * @property string $from
 * @property string $to
 * @property int $is_main_exam
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Classroom $classroom
 * @property-read \App\Models\CourseTeacher $courseTeacher
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ExamStudent> $examStudents
 * @property-read int|null $exam_students_count
 * @property-read \App\Data\Shared\ModelwithPivotCollection<\App\Models\User,\Illuminate\Database\Eloquent\Relations\Pivot> $students
 * @property-read int|null $students_count
 *
 * @method static \Database\Factories\ExamFactory factory($count = null, $state = [])
 * @method static Illuminate\Database\Eloquent\Builder<static> joinRelationship(string $relations, \Closure(Illuminate\Database\Query\JoinClause $join)|array $join_callback_or_array)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam newQuery()
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereClassroomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereCourseTeacherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereIsMainExam($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereMaxMark($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Exam extends Pivot
{
    /** @use HasFactory<\Database\Factories\ExamFactory> */
    use HasFactory;

    protected $table = 'exams';

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
        return $this->belongsTo(
            CourseTeacher::class,
            'course_teacher_id'
        );
    }

    /**
     * Summary of students
     *
     * @return BelongsToMany<User, $this, Pivot>
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'exam_students', 'exam_id',
            'student_id'
        );
    }

    /**
     * Summary of examStudents
     *
     * @return HasMany<ExamStudent, $this>
     */
    public function examStudents(): HasMany
    {
        return $this->hasMany(
            ExamStudent::class,
            'exam_id',
            'id'
        );
    }
}
