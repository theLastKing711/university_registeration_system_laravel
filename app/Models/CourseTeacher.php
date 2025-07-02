<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property int $id
 * @property int $course_id
 * @property int $teacher_id
 * @property int $is_main_teacher
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CourseAttendance> $attendances
 * @property-read int|null $attendances_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Classroom$this> $classroomCourseTeachers
 * @property-read int|null $classroom_course_teachers_count
 * @property-read \App\Data\Shared\ModelwithPivotCollection<\App\Models\Classroom,\Illuminate\Database\Eloquent\Relations\Pivot> $classrooms
 * @property-read int|null $classrooms_count
 * @property-read \App\Models\OpenCourseRegisteration $course
 * @property-read \App\Data\Shared\ModelwithPivotCollection<\App\Models\Classroom,\Illuminate\Database\Eloquent\Relations\Pivot> $examClassrooms
 * @property-read int|null $exam_classrooms_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Exam> $exams
 * @property-read int|null $exams_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Lecture> $lectures
 * @property-read int|null $lectures_count
 * @property-read \App\Data\Shared\ModelwithPivotCollection<\App\Models\User,\Illuminate\Database\Eloquent\Relations\Pivot> $studenAttendances
 * @property-read int|null $studen_attendances_count
 * @property-read \App\Models\Teacher $teacher
 *
 * @method static Illuminate\Database\Eloquent\Builder<static> joinRelationship(string $relations, \Closure(Illuminate\Database\Query\JoinClause $join)|array $join_callback_or_array)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseTeacher newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseTeacher newQuery()
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseTeacher query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseTeacher whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseTeacher whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseTeacher whereIsMainTeacher($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseTeacher whereTeacherId($value)
 *
 * @mixin \Eloquent
 */
class CourseTeacher extends Pivot
{
    protected $table = 'course_teacher';

    /**
     * Summary of course
     *
     * @return BelongsTo<OpenCourseRegisteration, $this>
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(OpenCourseRegisteration::class, 'course_id');
    }

    /**
     * Summary of teacher
     *
     * @return BelongsTo<Teacher, $this>
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * Summary of lectures
     *
     * @return HasMany<Lecture, $this>
     */
    public function lectures(): HasMany
    {
        return $this->hasMany(Lecture::class, 'course_teacher_id');
    }

    /**
     * Summary of classroomCourseTeachers
     *
     * @return HasMany<ClassroomCourseTeacher, $this>
     */
    public function classroomCourseTeachers(): HasMany
    {
        return
            $this
                ->hasMany(
                    ClassroomCourseTeacher::class,
                    'course_teacher_id'
                );
    }

    /**
     * Summary of classrooms
     *
     * @return BelongsToMany<Classroom, $this, Pivot>
     */
    public function classrooms(): BelongsToMany
    {
        return
            $this
                ->belongsToMany(
                    Classroom::class,
                    'classroom_course_teacher',
                    'course_teacher_id'
                )
                ->withTimestamps();
    }

    /**
     * Summary of exams
     *
     * @return HasMany<Exam, $this>
     */
    public function exams(): HasMany
    {
        return $this->hasMany(Exam::class, 'course_teacher_id');
    }

    public function examClassrooms(): BelongsToMany
    {
        return $this->belongsToMany(
            Classroom::class,
            'exams',
            'course_teacher_id'
        );
    }

    /**
     * Summary of studenAttendances
     *
     * @return BelongsToMany<User, $this, Pivot>
     */
    public function studenAttendances(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'course_attendance',
            'course_teacher_id',
            'student_id'
        )
            ->withPivot('updated_at');
    }

    /**
     * Summary of attendances
     *
     * @return HasMany<CourseAttendance, $this>
     */
    public function attendances(): HasMany
    {
        return $this->hasMany(
            CourseAttendance::class,
            'course_teacher_id',
        );
    }
}
