<?php

use App\Enum\Auth\RolesEnum;
use App\Http\Controllers\Admin\Course\CreateCourseController;
use App\Http\Controllers\Admin\Course\DeleteCoursesController;
use App\Http\Controllers\Admin\Course\OpenForRegisterationController;
use App\Http\Controllers\Admin\Department\CloseDepartmentForRegisterationController;
use App\Http\Controllers\Admin\Department\CreateDepartmentController;
use App\Http\Controllers\Admin\Department\DeleteDepartmentController;
use App\Http\Controllers\Admin\Department\OpenDepartmentForRegisterationController;
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
    ->middleware(['api'])
    ->group(function () {

        Route::prefix('courses')->group(function () {

            Route::get('', GetOpenCoursesThisSemesterController::class);

            Route::post('', RegisterCoursesController::class);

        });

    });

Route::prefix('admins')
    ->middleware(['api'])
    ->group(function () {
        $adminRole = RolesEnum::ADMIN->value;

        Route::prefix('students')->group(function () {

            Route::post('', RegisterStudentController::class);

            Route::patch('{id}', GraduateStudentController::class);

        });

        Route::prefix('teachers')->group(function () {

            Route::post('', CreateTeacherController::class);

            Route::delete('', DeleteTeachersController::class);

        });

        Route::prefix('departments')->group(function () {

            Route::patch('{id}/openForRegisteration', OpenDepartmentForRegisterationController::class);

            Route::patch('{id}/closeForRegisteration', CloseDepartmentForRegisterationController::class);

            Route::post('createdepartments', CreateDepartmentController::class);

            Route::delete('deletedepartments', DeleteDepartmentController::class);

        });

        Route::prefix('courses')->group(function () {

            Route::post('', CreateCourseController::class);
            Route::delete('', action: DeleteCoursesController::class);
            Route::post('openForRegisteration', OpenForRegisterationController::class);

        });

        // Route::middleware(['auth:sanctum', "role:{$adminRole}"])
        //     //auth:sanctum check if user is logged in (middleware('auth')),
        //     ->group(function () {

        //         Route::prefix('tests')
        //             ->group(function () {
        //                 Route::get('', [ExampleController::class, 'index']);
        //                 Route::get('{id}', [ExampleController::class, 'show_item']);

        //                 Route::get('queryParameters', [ExampleController::class, 'get_query_parameters']);

        //                 Route::post('post_json', [ExampleController::class, 'post_json']);

        //                 Route::patch('{id}', [ExampleController::class, 'patch_json']);
        //                 Route::delete('{id}', [ExampleController::class, 'delete_json']);

        //             });

        //     });

        // Route::prefix('auth')->group(function () {
        //     Route::post('login', [AuthController::class, 'login']);
        //     Route::post('logout', [AuthController::class, 'logout']);
        // });

    });
