<?php

use App\Enum\Auth\RolesEnum;
use App\Http\Controllers\Admin\AcademicYearSemester\CreateAcademicYearSemesterController;
use App\Http\Controllers\Admin\AcademicYearSemester\DeleteAcademicYearSemesterController;
use App\Http\Controllers\Admin\AcademicYearSemester\GetAcademicYearsSemestersController;
use App\Http\Controllers\Admin\AcademicYearSemester\OpenDepartmentsForRegisterationController;
use App\Http\Controllers\Admin\AcademicYearSemester\UpdateAcademicYearSemesterController;
use App\Http\Controllers\Admin\Admin\CreateAdminController;
use App\Http\Controllers\Admin\Admin\DeleteAdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ClassroomCourseTeacher\AssignClassroomToCourseTeacherController;
use App\Http\Controllers\Admin\ClassroomCourseTeacher\DeleteClassroomCourseTeacherController;
use App\Http\Controllers\Admin\ClassroomCourseTeacher\UpdateCourseTeacherClassroomController;
use App\Http\Controllers\Admin\Course\CreateCourseController;
use App\Http\Controllers\Admin\Course\DeleteCoursesController;
use App\Http\Controllers\Admin\Course\GetCourseController;
use App\Http\Controllers\Admin\Course\GetCoursesController;
use App\Http\Controllers\Admin\Course\UpdateCourseController;
use App\Http\Controllers\Admin\CourseTeacher\CreateCourseTeacherAttendanceController;
use App\Http\Controllers\Admin\CourseTeacher\DeleteCourseTeacherAttendaceController;
use App\Http\Controllers\Admin\CourseTeacher\GetCourseTeacherStudentsController;
use App\Http\Controllers\Admin\CourseTeacher\UpdateCourseTeacherAttendaceController;
use App\Http\Controllers\Admin\Department\CloseDepartmentForRegisterationController;
use App\Http\Controllers\Admin\Department\CreateDepartmentController;
use App\Http\Controllers\Admin\Department\DeleteDepartmentController;
use App\Http\Controllers\Admin\Department\GetDepartmentTeachersController;
use App\Http\Controllers\Admin\Department\GetSemesterCoursesController;
use App\Http\Controllers\Admin\Department\OpenDepartmentForRegisterationController;
use App\Http\Controllers\Admin\Exam\AssignMarkToStudentController;
use App\Http\Controllers\Admin\Exam\CreateExamController;
use App\Http\Controllers\Admin\Exam\DeleteExamController;
use App\Http\Controllers\Admin\Exam\GetExamController;
use App\Http\Controllers\Admin\Exam\GetExamsController;
use App\Http\Controllers\Admin\Exam\UpdateExamController;
use App\Http\Controllers\Admin\OpenCourseRegisteration\AssignTeacherToOpenCourseController;
use App\Http\Controllers\Admin\OpenCourseRegisteration\OpenCourseForRegisterationController;
use App\Http\Controllers\Admin\OpenCourseRegisteration\UnRegisterOpenCourseController;
use App\Http\Controllers\Admin\Student\DeleteStudentController;
use App\Http\Controllers\Admin\Student\GraduateStudentController;
use App\Http\Controllers\Admin\Student\RegisterStudentController;
use App\Http\Controllers\Admin\Student\UpdateStudentController;
use App\Http\Controllers\Admin\Teacher\CreateTeacherController;
use App\Http\Controllers\Admin\Teacher\DeleteTeachersController;
use App\Http\Controllers\Admin\Teacher\UpdateTeacherController;
use App\Http\Controllers\Student\OpenCourseRegisteration\GetCoursesMarksController;
use App\Http\Controllers\Student\OpenCourseRegisteration\GetCoursesMarksThisSemesterController;
use App\Http\Controllers\Student\OpenCourseRegisteration\GetOpenCoursesScheduleController;
use App\Http\Controllers\Student\OpenCourseRegisteration\GetOpenCoursesThisSemesterController;
use App\Http\Controllers\Student\OpenCourseRegisteration\GetStudentRegisteredOpenCoursesThisSemesterController;
use App\Http\Controllers\Student\OpenCourseRegisteration\RegisterOpenCoursesController;
use Illuminate\Support\Facades\Route;

// Route::prefix('files')
//     ->middleware(['api'])
//     ->group(function () {
//         Route::get('', [FileController::class, 'index']);
//         Route::post('', [FileController::class, 'store']);
//     });

Route::prefix('students')
    ->middleware(['api', 'auth:sanctum', RolesEnum::oneRoleOnlyMiddleware(RolesEnum::STUDENT)])
    ->group(function () {

        Route::prefix('course-registerations')
            ->group(function () {

                Route::prefix('offered-courses')
                    ->group(function () {

                        Route::prefix('this-semester')
                            ->group(function () {

                                Route::get('', action: GetOpenCoursesThisSemesterController::class);
                                Route::get('schedule', GetOpenCoursesScheduleController::class);

                            });

                    });

                Route::prefix('registered-courses')
                    ->group(function () {

                        Route::prefix('this-semester')
                            ->group(function () {

                                Route::get('', GetStudentRegisteredOpenCoursesThisSemesterController::class);
                                Route::post('', RegisterOpenCoursesController::class);
                                // Route::delete('{id}', UnRegisterOpenCourseController::class);

                            });

                        Route::prefix('marks')
                            ->group(function () {

                                Route::get('', GetCoursesMarksController::class);

                                Route::prefix('this-semester')
                                    ->group(function () {

                                        Route::get('', GetCoursesMarksThisSemesterController::class);

                                    });

                            });

                    });

            });

    });

Route::prefix('admins')
    ->middleware(['api'])
    ->group(function () {

        // must be logged in after making request to /sanctum and obtaining token to send here
        Route::middleware(['auth:sanctum'])->group(function () {

            Route::prefix('academic-year-semesters')
                ->middleware(
                    [
                        RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                    ]
                )
                ->group(function () {

                    Route::get('', GetAcademicYearsSemestersController::class);

                    Route::post('', CreateAcademicYearSemesterController::class);

                    Route::post('{id}/departments', OpenDepartmentsForRegisterationController::class);

                    Route::patch('{id}', UpdateAcademicYearSemesterController::class);

                    Route::delete('{id}', DeleteAcademicYearSemesterController::class);

                });

            Route::prefix('admins')
                ->middleware(
                    [
                        RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                    ]
                )
                ->group(function () {

                    Route::post('', CreateAdminController::class);

                    Route::delete('', DeleteAdminController::class);

                });

            Route::prefix('students')
                ->middleware([
                    RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                ])
                ->group(function () {

                    Route::post('', action: RegisterStudentController::class);

                    Route::patch('{id}', UpdateStudentController::class);

                    Route::patch('{id}/graduation', GraduateStudentController::class);

                    Route::delete('{id}', DeleteStudentController::class);

                });

            Route::prefix('exams')
                ->middleware([
                    RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                ])
                ->group(function () {

                    Route::get('', GetExamsController::class)->middleware([
                        RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                    ]);

                    Route::get('{id}', GetExamController::class)->middleware([
                        RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                    ]);

                    Route::post('', CreateExamController::class);

                    Route::post('{id}/students', AssignMarkToStudentController::class);

                    Route::patch('{id}', UpdateExamController::class);

                    Route::delete('{id}', DeleteExamController::class);

                });

            Route::prefix('teachers')
                ->middleware([
                    RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                ])
                ->group(function () {

                    Route::post('', CreateTeacherController::class);

                    Route::patch('{id}', UpdateTeacherController::class);

                    Route::delete('', DeleteTeachersController::class);

                });

            Route::prefix('departments')
                ->middleware([
                    RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                ])
                ->group(function () {

                    Route::get('{id}/open-course-registerations', GetSemesterCoursesController::class)->middleware([
                        RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                    ]);
                    Route::get('{id}/teachers', GetDepartmentTeachersController::class);

                    Route::post('', CreateDepartmentController::class);

                    Route::patch('{id}/open-for-registerations', OpenDepartmentForRegisterationController::class);
                    Route::patch('{id}/close-for-registerations', CloseDepartmentForRegisterationController::class);

                    Route::delete('', DeleteDepartmentController::class);

                });

            Route::prefix('course-teachers')
                ->group(function () {

                    Route::get('{id}/students', GetCourseTeacherStudentsController::class)
                        ->middleware([
                            RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                        ]);

                    Route::post('{id}/students', CreateCourseTeacherAttendanceController::class)->middleware([
                        RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                    ]);

                    Route::patch('{id}/students', UpdateCourseTeacherAttendaceController::class)
                        ->middleware([
                            RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                        ]);

                    Route::delete('{id}/students', DeleteCourseTeacherAttendaceController::class)
                        ->middleware([
                            RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                        ]);

                });

            // when dealing with the table directly not coming from course-teachers routes(or classrooms routes)
            // with course_teacher_id path route not set
            Route::prefix('classroom-course-teachers')
                ->group(function (): void {

                    Route::post('', AssignClassroomToCourseTeacherController::class)->middleware([
                        RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                    ]);

                    Route::patch('{id}', UpdateCourseTeacherClassroomController::class)->middleware([
                        RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                    ]);

                    Route::delete('{id}', DeleteClassroomCourseTeacherController::class)->middleware([
                        RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                    ]);

                });

            Route::prefix('courses')
                ->group(function () {

                    Route::get('', GetCoursesController::class);

                    Route::get('{id}', GetCourseController::class);

                    Route::post('', CreateCourseController::class);

                    Route::patch('{id}', UpdateCourseController::class);

                    Route::delete('', action: DeleteCoursesController::class)->middleware([
                        RolesEnum::oneRoleOnlyMiddleware(role: RolesEnum::ADMIN),
                    ]);

                });

            Route::prefix('open-course-registerations')
                ->group(function () {

                    Route::post('', OpenCourseForRegisterationController::class)
                        ->middleware(
                            RolesEnum::oneOfRolesMiddleware(RolesEnum::ADMIN, RolesEnum::COURSES_REGISTERER)
                        );

                    Route::post('teachers', AssignTeacherToOpenCourseController::class)->middleware([
                        RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                    ]);

                    Route::delete('{id}', UnRegisterOpenCourseController::class);

                });

        });

        // NEEDS CSRF TOKEN, EVEN THOUGH IT'S OUTSIDE auth:sanctum middleware
        Route::prefix('auth')->group(function () {
            Route::post('login', [AuthController::class, 'login']);
            Route::post('logout', [AuthController::class, 'logout']);
        });

    });
