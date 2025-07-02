<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Data\Shared\Media{
/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Media> $medially
 * @property-read int|null $medially_count
 * @method static \Illuminate\Database\Eloquent\Builder|ModelAndMediable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModelAndMediable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModelAndMediable query()
 * @method static  joinRelationship()
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
 * @mixin \Eloquent
 */
	class ModelAndMediable extends \Eloquent implements \App\Interfaces\Mediable {}
}

namespace App\Models{
/**
 * 
 *
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
 * @mixin \Eloquent
 */
	class AcademicYearSemester extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClassroomCourseTeacher> $classroomCourseTeachers
 * @property-read int|null $classroom_course_teachers_count
 * @property-read \App\Data\Shared\ModelwithPivotCollection<\App\Models\CourseTeacher,\Illuminate\Database\Eloquent\Relations\Pivot> $courseTeachers
 * @property-read int|null $course_teachers_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Exam> $exams
 * @property-read int|null $exams_count
 * @method static \Database\Factories\ClassroomFactory factory($count = null, $state = [])
 * @method static Illuminate\Database\Eloquent\Builder<static> joinRelationship(string $relations, \Closure(Illuminate\Database\Query\JoinClause $join)|array $join_callback_or_array)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Classroom newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Classroom newQuery()
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Classroom query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Classroom whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Classroom whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Classroom whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Classroom whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Classroom extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
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
 * @mixin \Eloquent
 */
	class ClassroomCourseTeacher extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $department_id
 * @property string $name
 * @property string $code
 * @property int $is_active
 * @property int $credits
 * @property int $open_for_students_in_year
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CrossListedCourses> $SecondCrossListedCourses
 * @property-read int|null $second_cross_listed_courses_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CourseTeacher> $courseTeachers
 * @property-read int|null $course_teachers_count
 * @property-read \App\Data\Shared\ModelwithPivotCollection<\App\Models\Course,\Illuminate\Database\Eloquent\Relations\Pivot> $coursesPrerequisites
 * @property-read int|null $courses_prerequisites_count
 * @property-read \App\Models\Department|null $department
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CrossListedCourses> $firstCrossListedCourses
 * @property-read int|null $first_cross_listed_courses_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OpenCourseRegisteration> $openCourseRegisterations
 * @property-read int|null $open_course_registerations_count
 * @property-read \App\Data\Shared\ModelwithPivotCollection<\App\Models\AcademicYearSemester,\Illuminate\Database\Eloquent\Relations\Pivot> $openedYearsSemesters
 * @property-read int|null $opened_years_semesters_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Prerequisite> $prerequisites
 * @property-read int|null $prerequisites_count
 * @property-read \App\Data\Shared\ModelwithPivotCollection<\App\Models\Teacher,\Illuminate\Database\Eloquent\Relations\Pivot> $teachers
 * @property-read int|null $teachers_count
 * @method static \Database\Factories\CourseFactory factory($count = null, $state = [])
 * @method static Illuminate\Database\Eloquent\Builder<static> joinRelationship(string $relations, \Closure(Illuminate\Database\Query\JoinClause $join)|array $join_callback_or_array)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course newQuery()
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereCredits($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereOpenForStudentsInYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Data\Shared\ModelwithPivotCollection<\App\Models\Course,\Illuminate\Database\Eloquent\Relations\Pivot> $firstCrossListed
 * @property-read int|null $first_cross_listed_count
 * @property-read \App\Data\Shared\ModelwithPivotCollection<\App\Models\Course,\Illuminate\Database\Eloquent\Relations\Pivot> $secondCrossListed
 * @property-read int|null $second_cross_listed_count
 */
	class Course extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $lecture_id
 * @property int $student_id
 * @property int $is_student_present
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Lecture $lecture
 * @property-read \App\Models\User $student
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
 * @mixin \Eloquent
 */
	class CourseAttendance extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $course_id
 * @property int $teacher_id
 * @property int $is_main_teacher
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CourseAttendance> $attendances
 * @property-read int|null $attendances_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClassroomCourseTeacher> $classroomCourseTeachers
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
 * @mixin \Eloquent
 */
	class CourseTeacher extends \Eloquent {}
}

namespace App\Models{
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
	class CrossListedCourses extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property int $is_course_registeration_open
 * @property string $course_registeration_year
 * @property int $course_registeration_semester
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Course> $courses
 * @property-read int|null $courses_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DepartmentRegisterationPeriod> $openRegisterations
 * @property-read int|null $open_registerations_count
 * @property-read \App\Data\Shared\ModelwithPivotCollection<\App\Models\AcademicYearSemester,\Illuminate\Database\Eloquent\Relations\Pivot> $openedAcademicyears
 * @property-read int|null $opened_academicyears_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $students
 * @property-read int|null $students_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Teacher> $teachers
 * @property-read int|null $teachers_count
 * @method static \Database\Factories\DepartmentFactory factory($count = null, $state = [])
 * @method static Illuminate\Database\Eloquent\Builder<static> joinRelationship(string $relations, \Closure(Illuminate\Database\Query\JoinClause $join)|array $join_callback_or_array)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department newQuery()
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereCourseRegisterationSemester($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereCourseRegisterationYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereIsCourseRegisterationOpen($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Department extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $department_id
 * @property int $academic_year_semester_id
 * @property int $is_open_for_students
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \App\Models\AcademicYearSemester|null $academicSemesterYear
 * @property-read \App\Models\Department $department
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
 * @mixin \Eloquent
 */
	class DepartmentRegisterationPeriod extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
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
 * @mixin \Eloquent
 */
	class Exam extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $exam_id
 * @property int $student_id
 * @property int $mark
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ExamStudentFactory factory($count = null, $state = [])
 * @method static Illuminate\Database\Eloquent\Builder<static> joinRelationship(string $relations, \Closure(Illuminate\Database\Query\JoinClause $join)|array $join_callback_or_array)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamStudent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamStudent newQuery()
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamStudent query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamStudent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamStudent whereExamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamStudent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamStudent whereMark($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamStudent whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamStudent whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class ExamStudent extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
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
 * @mixin \Eloquent
 */
	class Lecture extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $medially_type
 * @property int $medially_id
 * @property string $file_url
 * @property string $file_name
 * @property string|null $file_type
 * @property int $size
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\MediaFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Media newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Media newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Media query()
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereFileType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereFileUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereMediallyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereMediallyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereUpdatedAt($value)
 * @property-read Model|\Eloquent $medially
 * @method static joinRelationship()
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
 * @mixin \Eloquent
 */
	class Media extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $course_id
 * @property int $academic_year_semester_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \App\Models\AcademicYearSemester $academicYearSemester
 * @property-read \App\Models\Course $course
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CourseTeacher> $courseTeachers
 * @property-read int|null $course_teachers_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StudentCourseRegisteration> $studentCourseRegisterations
 * @property-read int|null $student_course_registerations_count
 * @property-read \App\Data\Shared\ModelwithPivotCollection<\App\Models\User,\Illuminate\Database\Eloquent\Relations\Pivot> $students
 * @property-read int|null $students_count
 * @property-read \App\Data\Shared\ModelwithPivotCollection<\App\Models\Teacher,\Illuminate\Database\Eloquent\Relations\Pivot> $teachers
 * @property-read int|null $teachers_count
 * @method static \Database\Factories\OpenCourseRegisterationFactory factory($count = null, $state = [])
 * @method static Illuminate\Database\Eloquent\Builder<static> joinRelationship(string $relations, \Closure(Illuminate\Database\Query\JoinClause $join)|array $join_callback_or_array)
 * @method static Builder<static>|OpenCourseRegisteration newModelQuery()
 * @method static Builder<static>|OpenCourseRegisteration newQuery()
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
 * @method static Builder<static>|OpenCourseRegisteration query()
 * @method static Builder<static>|OpenCourseRegisteration whereAcademicYearSemesterId($value)
 * @method static Builder<static>|OpenCourseRegisteration whereCourseId($value)
 * @method static Builder<static>|OpenCourseRegisteration whereCreatedAt($value)
 * @method static Builder<static>|OpenCourseRegisteration whereId($value)
 * @method static Builder<static>|OpenCourseRegisteration whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class OpenCourseRegisteration extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $course_id
 * @property int $prerequisite_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Course $course
 * @property-read \App\Models\Course $prerequisite
 * @method static \Database\Factories\PrerequisiteFactory factory($count = null, $state = [])
 * @method static Illuminate\Database\Eloquent\Builder<static> joinRelationship(string $relations, \Closure(Illuminate\Database\Query\JoinClause $join)|array $join_callback_or_array)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Prerequisite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Prerequisite newQuery()
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Prerequisite query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Prerequisite whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Prerequisite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Prerequisite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Prerequisite wherePrerequisiteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Prerequisite whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Prerequisite extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $student_id
 * @property int $course_id
 * @property int|null $final_mark
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\OpenCourseRegisteration $course
 * @property-read \App\Models\User $student
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
 * @mixin \Eloquent
 */
	class StudentCourseRegisteration extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property int $department_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClassroomCourseTeacher> $classroomCourseTeachers
 * @property-read int|null $classroom_course_teachers_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CourseTeacher> $courseTeachers
 * @property-read int|null $course_teachers_count
 * @property-read \App\Data\Shared\ModelwithPivotCollection<\App\Models\OpenCourseRegisteration,\Illuminate\Database\Eloquent\Relations\Pivot> $courses
 * @property-read int|null $courses_count
 * @property-read \App\Models\Department $department
 * @method static \Database\Factories\TeacherFactory factory($count = null, $state = [])
 * @method static Illuminate\Database\Eloquent\Builder<static> joinRelationship(string $relations, \Closure(Illuminate\Database\Query\JoinClause $join)|array $join_callback_or_array)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher newQuery()
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Teacher extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $file_name
 * @property string $file_url
 * @property int $size
 * @property string|null $file_type
 * @property string $public_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\TemporaryUploadedImagesFactory factory($count = null, $state = [])
 * @method static Illuminate\Database\Eloquent\Builder<static> joinRelationship(string $relations, \Closure(Illuminate\Database\Query\JoinClause $join)|array $join_callback_or_array)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemporaryUploadedImages newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemporaryUploadedImages newQuery()
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemporaryUploadedImages query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemporaryUploadedImages whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemporaryUploadedImages whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemporaryUploadedImages whereFileType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemporaryUploadedImages whereFileUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemporaryUploadedImages whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemporaryUploadedImages wherePublicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemporaryUploadedImages whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemporaryUploadedImages whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemporaryUploadedImages whereUserId($value)
 * @mixin \Eloquent
 */
	class TemporaryUploadedImages extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereBirthdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEnrollmentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereGraduationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereManagesDepartmentWithId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereNationalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePhoneNumber($value)
 * @mixin \Eloquent
 */
	class User extends \Eloquent {}
}

