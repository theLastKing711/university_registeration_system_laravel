<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * 
 *
 * @property int $id
 * @property int $first_course_id
 * @property int $second_course_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Course $firstCourse
 * @property-read \App\Models\Course $secondCourse
 * @method static Illuminate\Database\Eloquent\Builder<static> joinRelationship(string $relations, \Closure(Illuminate\Database\Query\JoinClause $join)|array $join_callback_or_array)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CrossListedCourses newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CrossListedCourses newQuery()
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CrossListedCourses query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CrossListedCourses whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CrossListedCourses whereFirstCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CrossListedCourses whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CrossListedCourses whereSecondCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CrossListedCourses whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CrossListedCourses extends Pivot
{
    protected $table = 'cross_listed_courses';

    /**
     * Get the firstCourse that owns the CrossListedCourses
     */
    public function firstCourse(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'first_course_id');
    }

    /**
     * Get the secondCourse that owns the CrossListedCourses
     */
    public function secondCourse(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'second_course_id');
    }
}
