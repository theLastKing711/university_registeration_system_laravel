<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Data\Shared\ModelwithPivotCollection<\Spatie\Permission\Models\Permission,\Illuminate\Database\Eloquent\Relations\Pivot> $permissions
 * @property-read int|null $permissions_count
 * @property-read \App\Data\Shared\ModelwithPivotCollection<\Spatie\Permission\Models\Role,\Illuminate\Database\Eloquent\Relations\Pivot> $roles
 * @property-read int|null $roles_count
 *
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static Illuminate\Database\Eloquent\Builder<static> joinRelationship(string $relations, \Closure(Illuminate\Database\Query\JoinClause $join)|array $join_callback_or_array)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User permission($permissions, $without = false)
 * @method static Illuminate\Database\Eloquent\Builder<static> powerJoinHas(string $relations, mixed operater, mixed value)
 * @method static Illuminate\Database\Eloquent\Builder<static> powerJoinWhereHas(string $relations, \Closure(Illuminate\Database\Query\JoinClause $join)|array $join_callback_or_array)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutRole($roles, $guard = null)
 *
 * @property int|null $department_id
 * @property string|null $national_id
 * @property string|null $birthdate
 * @property string|null $enrollment_date
 * @property string|null $graduation_date
 * @property string|null $phone_number
 * @property int|null $manages_department_with_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CourseAttendance> $attendances
 * @property-read int|null $attendances_count
 * @property-read \App\Data\Shared\ModelwithPivotCollection<\App\Models\OpenCourseRegisteration,\Illuminate\Database\Eloquent\Relations\Pivot> $courses
 * @property-read int|null $courses_count
 * @property-read \App\Models\Department|null $department
 * @property-read \App\Data\Shared\ModelwithPivotCollection<\App\Models\Exam,\Illuminate\Database\Eloquent\Relations\Pivot> $examStudent
 * @property-read int|null $exam_student_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ExamStudent> $exams
 * @property-read int|null $exams_count
 * @property-read \App\Data\Shared\ModelwithPivotCollection<\App\Models\CourseTeacher,\Illuminate\Database\Eloquent\Relations\Pivot> $lectures
 * @property-read int|null $lectures_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StudentCourseRegisteration> $studentCourseRegisterations
 * @property-read int|null $student_course_registerations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TemporaryUploadedImages> $temporaryUploadedImages
 * @property-read int|null $temporary_uploaded_images_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereBirthdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEnrollmentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereGraduationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereManagesDepartmentWithId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereNationalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePhoneNumber($value)
 *
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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
     * Summary of temporaryUploadedImages
     *
     * @return HasMany<TemporaryUploadedImages, $this>
     */
    public function temporaryUploadedImages(): HasMany
    {
        return $this->hasMany(TemporaryUploadedImages::class);
    }

    // student relations

    /**
     * Summary of lectures
     *
     * @return BelongsToMany<CourseTeacher, $this, \Illuminate\Database\Eloquent\Relations\Pivot>
     */
    public function lectures(): BelongsToMany
    {
        return $this->belongsToMany(
            CourseTeacher::class,
            'course_attendance',
            'student_id',
            'lecture_id'
        );
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
            'student_id',
        );
    }

    /**
     * Summary of examStudent
     *
     * @return BelongsToMany<Exam, $this, \Illuminate\Database\Eloquent\Relations\Pivot>
     */
    public function examStudent(): BelongsToMany
    {
        return $this->belongsToMany(
            Exam::class,
            'exam_students',
            foreignPivotKey: 'student_id',
            relatedPivotKey: 'exam_id'
        );
    }

    /**
     * Summary of exams
     *
     * @return HasMany<ExamStudent, $this>
     */
    public function exams(): HasMany
    {
        return $this->hasMany(
            ExamStudent::class,
            'student_id',
            'id'
        );
    }

    /**
     * Summary of courses
     *
     * @return BelongsToMany<OpenCourseRegisteration, User, \Illuminate\Database\Eloquent\Relations\Pivot>
     */
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(
            OpenCourseRegisteration::class,
            'student_course_registerations',
            'student_id',
            'course_id'
        );
    }

    /**
     * Summary of studentCourseRegisterations
     *
     * @return HasMany<StudentCourseRegisteration, $this>
     */
    public function studentCourseRegisterations(): HasMany
    {
        return $this->hasMany(StudentCourseRegisteration::class, 'student_id');
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            // 'enrollment_date' => 'datetime:Y-m-d',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
