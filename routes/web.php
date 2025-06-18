<?php

use App\Enum\Auth\RolesEnum;
use App\Http\Controllers\Admin\Admin\CreateAdminController;
use App\Http\Controllers\Admin\Admin\DeleteAdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\Course\DeleteCoursesController;
use App\Http\Controllers\Admin\CourseTeacher\AssignClassroomToCourseTeacherController;
use App\Http\Controllers\Admin\CourseTeacher\CreateCourseTeacherAttendanceController;
use App\Http\Controllers\Admin\CourseTeacher\CreateCourseTeacherExamController;
use App\Http\Controllers\Admin\CourseTeacher\GetCourseTeacherExamsController;
use App\Http\Controllers\Admin\CourseTeacher\GetCourseTeacherStudentsController;
use App\Http\Controllers\Admin\Department\CloseDepartmentForRegisterationController;
use App\Http\Controllers\Admin\Department\CreateDepartmentController;
use App\Http\Controllers\Admin\Department\DeleteDepartmentController;
use App\Http\Controllers\Admin\Department\GetSemesterCoursesController;
use App\Http\Controllers\Admin\Department\OpenDepartmentForRegisterationController;
use App\Http\Controllers\Admin\Exam\AssignMarkToStudentController;
use App\Http\Controllers\Admin\OpenCourseRegisteration\AssignTeacherToOpenCourseController;
use App\Http\Controllers\Admin\OpenCourseRegisteration\OpenCourseForRegisterationController;
use App\Http\Controllers\Admin\Student\GraduateStudentController;
use App\Http\Controllers\Admin\Student\RegisterStudentController;
use App\Http\Controllers\Admin\Teacher\CreateTeacherController;
use App\Http\Controllers\Admin\Teacher\DeleteTeachersController;
use App\Http\Controllers\Student\Course\GetCoursesMarksController;
use App\Http\Controllers\Student\Course\GetCoursesScheduleController;
use App\Http\Controllers\Student\Course\GetOpenCoursesThisSemesterController;
use App\Http\Controllers\Student\Course\RegisterCoursesController;
use Illuminate\Support\Facades\Route;

// Route::prefix('files')
//     ->middleware(['api'])
//     ->group(function () {
//         Route::get('', [FileController::class, 'index']);
//         Route::post('', [FileController::class, 'store']);
//     });

Route::prefix('students')
    ->middleware(['api', 'auth:sanctum'])
    ->group(function () {

        Route::prefix('courses')
            ->middleware(
                [
                    RolesEnum::oneRoleOnlyMiddleware(RolesEnum::STUDENT),
                ]
            )
            ->group(function () {

                Route::get('', action: GetOpenCoursesThisSemesterController::class);
                Route::get('schedule', GetCoursesScheduleController::class);
                Route::get('marks', GetCoursesMarksController::class);

                Route::post('', RegisterCoursesController::class);

            });

    });

Route::prefix('admins')
    ->middleware(['api'])
    ->group(function () {

        // must be logged in after making request to /sanctum and obtaining token to send here
        Route::middleware(['auth:sanctum'])->group(function () {
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

                    Route::patch('{id}/graduation', GraduateStudentController::class);

                });

            Route::prefix('exams')
                ->middleware([
                    RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                ])
                ->group(function () {

                    Route::post('{id}/students', AssignMarkToStudentController::class);
                });

            Route::prefix('teachers')
                ->middleware([
                    RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                ])
                ->group(function () {

                    Route::post('', CreateTeacherController::class);

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

                    Route::post('', CreateDepartmentController::class);

                    Route::patch('{id}/open-for-registerations', OpenDepartmentForRegisterationController::class);
                    Route::patch('{id}//close-for-registerations', CloseDepartmentForRegisterationController::class);

                    Route::delete('', DeleteDepartmentController::class);

                });

            Route::prefix('course-teachers')

                ->group(function () {
                    Route::get('{id}/exams', GetCourseTeacherExamsController::class)->middleware([
                        RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                    ]);

                    Route::get('{id}/students', GetCourseTeacherStudentsController::class)
                        ->middleware([
                            RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                        ]);

                    Route::post('classrooms', AssignClassroomToCourseTeacherController::class)->middleware([
                        RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                    ]);

                    Route::post('exams', CreateCourseTeacherExamController::class)->middleware([
                        RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                    ]);

                    Route::post('course-attendances', CreateCourseTeacherAttendanceController::class)->middleware([
                        RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                    ]);

                });

            Route::prefix('courses')

                ->group(function () {

                    Route::delete('', action: DeleteCoursesController::class)->middleware([
                        RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
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

                });

        });

    });

// NEEDS CSRF TOKEN, EVEN THOUGH IT'S OUTSIDE auth:sanctum middleware
Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
});
