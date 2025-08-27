<?php

use App\Enum\Auth\RolesEnum;
use App\Http\Controllers\Admin\AcademicYearSemester\CreateAcademicYearSemesterController;
use App\Http\Controllers\Admin\AcademicYearSemester\DeleteAcademicYearSemesterController;
use App\Http\Controllers\Admin\AcademicYearSemester\GetAcademicYearsSemesterController;
use App\Http\Controllers\Admin\AcademicYearSemester\GetAcademicYearsSemestersController;
use App\Http\Controllers\Admin\AcademicYearSemester\GetAcademicYearsSemestersListController;
use App\Http\Controllers\Admin\AcademicYearSemester\OpenDepartmentsForRegisterationController;
use App\Http\Controllers\Admin\AcademicYearSemester\UpdateAcademicYearSemesterController;
use App\Http\Controllers\Admin\Admin\CreateAdminController;
use App\Http\Controllers\Admin\Admin\DeleteAdminController;
use App\Http\Controllers\Admin\Admin\GetAdminController;
use App\Http\Controllers\Admin\Admin\GetAdminsController;
use App\Http\Controllers\Admin\Admin\UpdateAdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\Classroom\CreateClassroomController;
use App\Http\Controllers\Admin\Classroom\DeleteClassroomController;
use App\Http\Controllers\Admin\Classroom\GetClassroomController;
use App\Http\Controllers\Admin\Classroom\GetClassroomListController;
use App\Http\Controllers\Admin\Classroom\GetClassroomsController;
use App\Http\Controllers\Admin\Classroom\UpdateClassroomController;
use App\Http\Controllers\Admin\ClassroomCourseTeacher\CreateClassroomCourseTeacherController;
use App\Http\Controllers\Admin\ClassroomCourseTeacher\DeleteClassroomCourseTeacherController;
use App\Http\Controllers\Admin\ClassroomCourseTeacher\GetClassroomCourseTeacherController;
use App\Http\Controllers\Admin\ClassroomCourseTeacher\GetClassroomCourseTeachersController;
use App\Http\Controllers\Admin\ClassroomCourseTeacher\UpdateCourseTeacherClassroomController;
use App\Http\Controllers\Admin\Course\CreateCourseController;
use App\Http\Controllers\Admin\Course\DeleteCourseController;
use App\Http\Controllers\Admin\Course\DeleteCoursesController;
use App\Http\Controllers\Admin\Course\GetCourseController;
use App\Http\Controllers\Admin\Course\GetCoursesController;
use App\Http\Controllers\Admin\Course\GetCoursesListController;
use App\Http\Controllers\Admin\Course\UpdateCourseController;
use App\Http\Controllers\Admin\CourseTeacher\CreateCourseTeacherAttendanceController;
use App\Http\Controllers\Admin\CourseTeacher\DeleteCourseTeacherAttendaceController;
use App\Http\Controllers\Admin\CourseTeacher\GetCourseTeacherExamsController;
use App\Http\Controllers\Admin\CourseTeacher\GetCourseTeacherLecturesController;
use App\Http\Controllers\Admin\CourseTeacher\GetCourseTeacherStudentsController;
use App\Http\Controllers\Admin\CourseTeacher\UpdateCourseTeacherAttendaceController;
use App\Http\Controllers\Admin\Department\CreateDepartmentController;
use App\Http\Controllers\Admin\Department\DeleteDepartmentController;
use App\Http\Controllers\Admin\Department\GetDepartmentsController;
use App\Http\Controllers\Admin\Department\GetDepartmentTeachersController;
use App\Http\Controllers\Admin\Department\UpdateDepartmentController;
use App\Http\Controllers\Admin\Exam\AssignMarkToStudentController;
use App\Http\Controllers\Admin\Exam\CreateExamController;
use App\Http\Controllers\Admin\Exam\DeleteExamController;
use App\Http\Controllers\Admin\Exam\GetExamController;
use App\Http\Controllers\Admin\Exam\GetExamsController;
use App\Http\Controllers\Admin\Exam\GetExamsScheduleController;
use App\Http\Controllers\Admin\Exam\UpdateExamController;
use App\Http\Controllers\Admin\Exam\UpdateStudentExamMarkController;
use App\Http\Controllers\Admin\Image\UploadImageController;
use App\Http\Controllers\Admin\Lecture\CreateLectureController;
use App\Http\Controllers\Admin\Lecture\GetLectureController;
use App\Http\Controllers\Admin\Lecture\GetLecturesController;
use App\Http\Controllers\Admin\Lecture\UpdateLectureController;
use App\Http\Controllers\Admin\OpenCourseRegisteration\AssignTeacherToOpenCourseController;
use App\Http\Controllers\Admin\OpenCourseRegisteration\CreateOpenCourseRegisterationController;
use App\Http\Controllers\Admin\OpenCourseRegisteration\GetOpenCourseRegisterationsController;
use App\Http\Controllers\Admin\OpenCourseRegisteration\GetOpenCourseRegisterationsListController;
use App\Http\Controllers\Admin\OpenCourseRegisteration\OpenCourseForRegisterationController;
use App\Http\Controllers\Admin\OpenCourseRegisteration\UnAssignTeacherFromOpenCourseController;
use App\Http\Controllers\Admin\OpenCourseRegisteration\UnRegisterOpenCourseController;
use App\Http\Controllers\Admin\Student\DeleteStudentController;
use App\Http\Controllers\Admin\Student\DeleteStudentProfilePictureController;
use App\Http\Controllers\Admin\Student\GetStudentController;
use App\Http\Controllers\Admin\Student\GetStudentsController;
use App\Http\Controllers\Admin\Student\GetStudentsListController;
use App\Http\Controllers\Admin\Student\GraduateStudentController;
use App\Http\Controllers\Admin\Student\RegisterStudentController;
use App\Http\Controllers\Admin\Student\UpdateStudentController;
use App\Http\Controllers\Admin\Student\UploadStudentProfilePictureController;
use App\Http\Controllers\Admin\Student\UploadStudentSchoolFilesController;
use App\Http\Controllers\Admin\Teacher\CreateTeacherController;
use App\Http\Controllers\Admin\Teacher\DeleteTeacherController;
use App\Http\Controllers\Admin\Teacher\DeleteTeachersController;
use App\Http\Controllers\Admin\Teacher\GetTeacherController;
use App\Http\Controllers\Admin\Teacher\GetTeachersController;
use App\Http\Controllers\Admin\Teacher\GetTeachersListController;
use App\Http\Controllers\Admin\Teacher\GetTeachersPaginatedController;
use App\Http\Controllers\Admin\Teacher\UpdateTeacherController;
use App\Http\Controllers\Student\OpenCourseRegisteration\GetCoursesMarksController;
use App\Http\Controllers\Student\OpenCourseRegisteration\GetCoursesMarksThisSemesterController;
use App\Http\Controllers\Student\OpenCourseRegisteration\GetOpenCoursesScheduleController;
use App\Http\Controllers\Student\OpenCourseRegisteration\GetOpenCoursesThisSemesterController;
use App\Http\Controllers\Student\OpenCourseRegisteration\GetStudentRegisteredOpenCoursesThisSemesterController;
use App\Http\Controllers\Student\OpenCourseRegisteration\RegisterInOpenCoursesController;
use App\Http\Controllers\Student\OpenCourseRegisteration\UnRegisterFromOpenCourseController;
use Illuminate\Support\Facades\Route;

// Route::prefix('files')
//     ->middleware(['api'])
//     ->group(function () {
//         Route::get('', [FileController::class, 'index']);
//         Route::post('', [FileController::class, 'store']);
//     });

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

                    Route::get('list', GetAcademicYearsSemestersListController::class);

                    Route::get('', GetAcademicYearsSemestersController::class);

                    Route::get('{id}', GetAcademicYearsSemesterController::class);

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

                    Route::get('', GetAdminsController::class);

                    Route::get('{id}', GetAdminController::class);

                    Route::post('', CreateAdminController::class);

                    Route::patch('{id}', UpdateAdminController::class);

                    Route::delete('{id}', DeleteAdminController::class);

                });

            Route::prefix('classrooms')
                ->group(function () {

                    Route::get('', GetClassroomsController::class);

                    Route::get('list', GetClassroomListController::class);

                    Route::get('{id}', GetClassroomController::class);

                    Route::post('', CreateClassroomController::class);

                    Route::patch('{id}', UpdateClassroomController::class);

                    Route::delete('{id}', DeleteClassroomController::class);

                    // Route::get('{id}/lectures', GetCourseTeacherLecturesController::class)
                    //     ->middleware([
                    //         RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                    //     ]);

                    // Route::post('{id}/lectures', CreateCourseTeacherAttendanceController::class)->middleware([
                    //     RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                    // ]);

                    // Route::patch('{id}/lectures/{lecture_id}', UpdateCourseTeacherAttendaceController::class)
                    //     ->middleware([
                    //         RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                    //     ]);

                    // Route::delete('{id}/lectures/{lecture_id}', DeleteCourseTeacherAttendaceController::class)
                    //     ->middleware([
                    //         RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                    //     ]);

                    // Route::get('{id}/students', GetCourseTeacherStudentsController::class)
                    //     ->middleware([
                    //         RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                    //     ]);

                    // Route::get('{id}/exams', GetCourseTeacherExamsController::class)
                    //     ->middleware([
                    //         RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                    //     ]);

                });

            Route::prefix('course-teachers')
                ->group(function () {

                    // Route::get('{id}/lectures', GetCourseTeacherLecturesController::class)
                    //     ->middleware([
                    //         RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                    //     ]);

                    // Route::post('{id}/lectures', CreateCourseTeacherAttendanceController::class)->middleware([
                    //     RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                    // ]);

                    // Route::patch('{id}/lectures/{lecture_id}', UpdateCourseTeacherAttendaceController::class)
                    //     ->middleware([
                    //         RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                    //     ]);

                    // Route::delete('{id}/lectures/{lecture_id}', DeleteCourseTeacherAttendaceController::class)
                    //     ->middleware([
                    //         RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                    //     ]);

                    Route::get('{id}/students', GetCourseTeacherStudentsController::class)
                        ->middleware([
                            RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                        ]);

                    Route::get('{id}/exams', GetCourseTeacherExamsController::class)
                        ->middleware([
                            RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                        ]);

                });

            // when dealing with the table directly not coming from course-teachers routes(or classrooms routes)
            // with course_teacher_id path route not set
            Route::prefix('classroom-course-teachers')
                ->group(function (): void {

                    Route::get('', GetClassroomCourseTeachersController::class);

                    Route::get('{id}', GetClassroomCourseTeacherController::class);

                    Route::post('', CreateClassroomCourseTeacherController::class)->middleware([
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

                    Route::get('list', GetCoursesListController::class);

                    Route::get('{id}', GetCourseController::class);

                    Route::post('', CreateCourseController::class);

                    Route::patch('{id}', UpdateCourseController::class);

                    Route::delete('{id}', DeleteCourseController::class);

                    Route::delete('', action: DeleteCoursesController::class)->middleware([
                        RolesEnum::oneRoleOnlyMiddleware(role: RolesEnum::ADMIN),
                    ]);

                });

            Route::prefix('departments')
                ->middleware([
                    RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                ])
                ->group(function () {

                    Route::get('', action: GetDepartmentsController::class);

                    Route::get('{id}/teachers', action: GetDepartmentTeachersController::class);

                    Route::post('', CreateDepartmentController::class);

                    Route::patch('{id}', action: UpdateDepartmentController::class);

                    Route::delete('', DeleteDepartmentController::class);

                });

            Route::prefix('exams')
                ->middleware([
                    RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                ])
                ->group(function () {

                    Route::get('', GetExamsController::class);

                    Route::get('schedule', GetExamsScheduleController::class);

                    Route::get('{id}', GetExamController::class);

                    Route::post('', CreateExamController::class);

                    Route::post('{id}/students', AssignMarkToStudentController::class);

                    Route::patch('{id}/students', UpdateStudentExamMarkController::class);

                    Route::patch('{id}', UpdateExamController::class);

                    Route::delete('{id}', DeleteExamController::class);

                });

            Route::prefix('images')
                ->middleware(
                    [
                        RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                    ]
                )
                ->group(function () {

                    Route::post('', UploadImageController::class);

                });

            Route::prefix('lectures')
                ->middleware(
                    [
                        RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                    ]
                )
                ->group(function () {

                    Route::get('', GetLecturesController::class);

                    Route::get('{id}', GetLectureController::class);

                    Route::post('', CreateLectureController::class);

                    Route::patch('{id}', UpdateLectureController::class);

                    Route::delete('{id}', DeleteCourseController::class);

                });

            Route::prefix('open-course-registerations')
                ->group(function () {

                    Route::get('', GetOpenCourseRegisterationsController::class);

                    Route::get('list', GetOpenCourseRegisterationsListController::class);

                    // Route::post('', OpenCourseForRegisterationController::class)
                    //     ->middleware(
                    //         RolesEnum::oneOfRolesMiddleware(RolesEnum::ADMIN, RolesEnum::COURSES_REGISTERER)
                    //     );

                    Route::post('', CreateOpenCourseRegisterationController::class)
                        ->middleware(
                            RolesEnum::oneOfRolesMiddleware(RolesEnum::ADMIN, RolesEnum::COURSES_REGISTERER)
                        );

                    Route::post('{id}/teachers', AssignTeacherToOpenCourseController::class);

                    Route::delete('{id}/teachers', UnAssignTeacherFromOpenCourseController::class);

                    Route::delete('{id}', UnRegisterOpenCourseController::class);

                });

            Route::prefix('students')
                ->middleware([
                    RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                ])
                ->group(function () {

                    Route::get('', action: GetStudentsController::class);

                    Route::get('list', action: GetStudentsListController::class);

                    Route::get('{id}', action: GetStudentController::class);

                    Route::post('', action: RegisterStudentController::class);

                    Route::post('profile-picture', UploadStudentProfilePictureController::class);

                    Route::post('school-files', UploadStudentSchoolFilesController::class);

                    Route::patch('{id}', UpdateStudentController::class);

                    Route::patch('{id}/graduation', GraduateStudentController::class);

                    Route::delete('{id}', DeleteStudentController::class);

                    Route::delete('{id}/profile-picture/{profile_picture_id}', DeleteStudentProfilePictureController::class);

                });

            Route::prefix('teachers')
                ->middleware([
                    RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                ])
                ->group(function () {

                    Route::get('paginated', GetTeachersPaginatedController::class);

                    Route::get('', GetTeachersController::class);

                    Route::get('list', GetTeachersListController::class);

                    Route::get('{id}', GetTeacherController::class);

                    Route::post('', CreateTeacherController::class);

                    Route::patch('{id}', UpdateTeacherController::class);

                    Route::delete('{id}', DeleteTeacherController::class);

                    Route::delete('', DeleteTeachersController::class);

                });

        });

        // NEEDS CSRF TOKEN, EVEN THOUGH IT'S OUTSIDE auth:sanctum middleware
        Route::prefix('auth')->group(function () {
            Route::post('login', [AuthController::class, 'login']);
            Route::post('logout', [AuthController::class, 'logout']);
        });

    });

Route::prefix('students')
    ->middleware(['api', 'auth:sanctum', RolesEnum::oneRoleOnlyMiddleware(RolesEnum::STUDENT)])
    ->group(function () {

        Route::prefix('open-course-registerations')->group(function () {

            Route::get('', action: GetOpenCoursesThisSemesterController::class);
            Route::get('schedule', GetOpenCoursesScheduleController::class);

            Route::get('marks', GetCoursesMarksController::class);

            Route::get('marks/this-semester', GetCoursesMarksThisSemesterController::class);

            Route::get('registered-courses/this-semester', GetStudentRegisteredOpenCoursesThisSemesterController::class);

            Route::post('', RegisterInOpenCoursesController::class);

            Route::delete('{id}', UnRegisterFromOpenCourseController::class);

        });

        // Route::prefix('course-registerations')
        //     ->group(function () {

        //         Route::prefix('offered-courses')
        //             ->group(function () {

        //                 Route::prefix('this-semester')
        //                     ->group(function () {

        //                         Route::get('', action: GetOpenCoursesThisSemesterController::class);
        //                         Route::get('schedule', GetOpenCoursesScheduleController::class);

        //                     });

        //             });

        //         Route::prefix('registered-courses')
        //             ->group(function () {

        //                 Route::prefix('this-semester')
        //                     ->group(function () {

        //                         Route::get('', GetStudentRegisteredOpenCoursesThisSemesterController::class);
        //                         Route::post('', RegisterInOpenCoursesController::class);
        //                         // Route::delete('{id}', UnRegisterOpenCourseController::class);

        //                     });

        //                 Route::prefix('marks')
        //                     ->group(function () {

        //                         Route::prefix('this-semester')
        //                             ->group(function () {

        //                                 Route::get('', GetCoursesMarksThisSemesterController::class);

        //                             });

        //                     });

        //             });

        //     });

    });
