<?php

use App\Enum\Auth\RolesEnum;
use App\Http\Controllers\Admin\Admin\CreateAdminController;
use App\Http\Controllers\Admin\Admin\DeleteAdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\Course\AssignClassroomToCourseController;
use App\Http\Controllers\Admin\Course\AssignTeacherToCourseController;
use App\Http\Controllers\Admin\Course\CreateCourseAttendanceController;
use App\Http\Controllers\Admin\Course\CreateCourseController;
use App\Http\Controllers\Admin\Course\CreateExamController;
use App\Http\Controllers\Admin\Course\DeleteCoursesController;
use App\Http\Controllers\Admin\Course\GetCourseExamsController;
use App\Http\Controllers\Admin\Course\GetCourseStudentsController;
use App\Http\Controllers\Admin\Course\GetSemesterCoursesController;
use App\Http\Controllers\Admin\Course\OpenForRegisterationController;
use App\Http\Controllers\Admin\Department\CloseDepartmentForRegisterationController;
use App\Http\Controllers\Admin\Department\CreateDepartmentController;
use App\Http\Controllers\Admin\Department\DeleteDepartmentController;
use App\Http\Controllers\Admin\Department\OpenDepartmentForRegisterationController;
use App\Http\Controllers\Admin\Student\AssignMarkToStudentController;
use App\Http\Controllers\Admin\Student\GraduateStudentController;
use App\Http\Controllers\Admin\Student\RegisterStudentController;
use App\Http\Controllers\Admin\Teacher\CreateTeacherController;
use App\Http\Controllers\Admin\Teacher\DeleteTeachersController;
use App\Http\Controllers\FileController;
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

                Route::get('', GetOpenCoursesThisSemesterController::class);

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

                    Route::post('', RegisterStudentController::class);
                    Route::post('assignMarkToStudent', AssignMarkToStudentController::class);

                    Route::patch('{id}', GraduateStudentController::class);

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

                    Route::patch('{id}/openForRegisteration', OpenDepartmentForRegisterationController::class);

                    Route::patch('{id}/closeForRegisteration', CloseDepartmentForRegisterationController::class);

                    Route::post('createdepartments', CreateDepartmentController::class);

                    Route::delete('deletedepartments', DeleteDepartmentController::class);

                });

            Route::prefix('courses')

                ->group(function () {

                    Route::get('getCourseStudents/{course_teacher_id}', GetCourseStudentsController::class)
                        ->middleware([
                            RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                        ]);

                    Route::get('getSemesterCourses/{id}', GetSemesterCoursesController::class)->middleware([
                        RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                    ]);

                    Route::get('{id}/getCourseExams', GetCourseExamsController::class)->middleware([
                        RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                    ]);

                    Route::post('', CreateCourseController::class)->middleware([
                        RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                    ]);

                    Route::post('assignCourseToTeacher', AssignTeacherToCourseController::class)->middleware([
                        RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                    ]);

                    Route::post('assignClassroomToCourse', AssignClassroomToCourseController::class)->middleware([
                        RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                    ]);

                    Route::post('createCourseAttendance', CreateCourseAttendanceController::class)->middleware([
                        RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                    ]);

                    Route::post('createExam', CreateExamController::class)->middleware([
                        RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                    ]);

                    Route::post('openForRegisteration', OpenForRegisterationController::class)
                        ->middleware(
                            RolesEnum::oneOfRolesMiddleware(RolesEnum::ADMIN, RolesEnum::COURSES_REGISTERER)
                        );

                    Route::delete('', action: DeleteCoursesController::class)->middleware([
                        RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                    ]);

                });

        });

        Route::prefix('auth')->group(function () {
            Route::post('login', [AuthController::class, 'login']);
            Route::post('logout', [AuthController::class, 'logout']);
        });

    });
