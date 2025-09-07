<?php

use App\Enum\Auth\PermissionsEnum;
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
use App\Http\Controllers\Admin\Department\GetDepartmentController;
use App\Http\Controllers\Admin\Department\GetDepartmentsController;
use App\Http\Controllers\Admin\Department\GetDepartmentsListController;
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
use App\Http\Controllers\Admin\GetRole\GetUserRoleController;
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
use App\Http\Controllers\Student\OpenCourseRegisteration\RegisterInOpenCourseController;
use App\Http\Controllers\Student\OpenCourseRegisteration\RegisterInOpenCoursesController;
use App\Http\Controllers\Student\OpenCourseRegisteration\UnRegisterFromOpenCourseController;
use Illuminate\Support\Facades\Route;

Route::prefix('admins')
    ->middleware(['api'])
    ->group(function () {

        // must be logged in after making request to /sanctum and obtaining token to send here
        Route::middleware(['auth:sanctum'])->group(function () {

            Route::prefix('academic-year-semesters')
                // ->middleware(
                //     [
                //         RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                //     ]
                // )
                ->group(function () {

                    Route::get('list', GetAcademicYearsSemestersListController::class);

                    Route::get('', GetAcademicYearsSemestersController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::SHOW_ACADEMIC_YEAR_SEMESTER
                            )
                        );

                    Route::get('{id}', GetAcademicYearsSemesterController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::SHOW_ACADEMIC_YEAR_SEMESTER
                            )
                        );

                    Route::post('', CreateAcademicYearSemesterController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::CREATE_ACADEMIC_YEAR_SEMESTER
                            )
                        );

                    Route::post('{id}/departments', OpenDepartmentsForRegisterationController::class);

                    Route::patch('{id}', UpdateAcademicYearSemesterController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::CREATE_ACADEMIC_YEAR_SEMESTER
                            )
                        );

                    Route::delete('{id}', DeleteAcademicYearSemesterController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::DELETE_ACADEMIC_YEAR_SEMESTER
                            )
                        );

                });

            Route::prefix('admins')
                ->group(function () {

                    Route::get('', GetAdminsController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::LIST_ADMIN
                            )
                        );

                    Route::get('role', GetUserRoleController::class);

                    Route::get('{id}', GetAdminController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::SHOW_ADMIN
                            )
                        );

                    Route::post('', CreateAdminController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::CREATE_ADMIN
                            )
                        );

                    Route::patch('{id}', UpdateAdminController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::EDIT_ADMIN
                            )
                        );

                    Route::delete('{id}', DeleteAdminController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::DELETE_ADMIN
                            )
                        );

                });

            Route::prefix('classrooms')
                ->group(function () {

                    Route::get('', GetClassroomsController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::LIST_ADMIN
                            )
                        );

                    Route::get('list', GetClassroomListController::class);

                    Route::get('{id}', GetClassroomController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::SHOW_CLASSROOM
                            )
                        );

                    Route::post('', CreateClassroomController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::CREATE_CLASSROOM
                            )
                        );

                    Route::patch('{id}', UpdateClassroomController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::EDIT_CLASSROOM
                            )
                        );

                    Route::delete('{id}', DeleteClassroomController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::DELETE_CLASSROOM
                            )
                        );

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

                    Route::get('', GetClassroomCourseTeachersController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::LIST_CLASSROOM_COURSE_TEACHER
                            )
                        );

                    Route::get('{id}', GetClassroomCourseTeacherController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::SHOW_CLASSROOM_COURSE_TEACHER
                            )
                        );

                    Route::post('', CreateClassroomCourseTeacherController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::CREATE_CLASSROOM_COURSE_TEACHER
                            )
                        );

                    Route::patch('{id}', UpdateCourseTeacherClassroomController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::SHOW_CLASSROOM_COURSE_TEACHER
                            )
                        );

                    Route::delete('{id}', DeleteClassroomCourseTeacherController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::DELETE_CLASSROOM_COURSE_TEACHER
                            )
                        );

                });

            Route::prefix('courses')
                ->group(function () {

                    Route::get('', GetCoursesController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::LIST_COURSE
                            )
                        );

                    Route::get('list', GetCoursesListController::class);

                    Route::get('{id}', GetCourseController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::SHOW_COURSE
                            )
                        );

                    Route::post('', CreateCourseController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::CREATE_COURSE
                            )
                        );

                    Route::patch('{id}', UpdateCourseController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::EDIT_COURSE
                            )
                        );

                    Route::delete('{id}', DeleteCourseController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::DELETE_COURSE
                            )
                        );

                    Route::delete('', action: DeleteCoursesController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::DELETE_COURSE
                            )
                        );

                });

            Route::prefix('departments')
                ->group(function () {

                    Route::get('', action: GetDepartmentsController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::LIST_DEPARTMENT
                            )
                        );

                    Route::get('list', action: GetDepartmentsListController::class);

                    Route::get('{id}', action: GetDepartmentController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::SHOW_DEPARTMENT
                            )
                        );

                    Route::get('{id}/teachers', action: GetDepartmentTeachersController::class);

                    Route::post('', CreateDepartmentController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::CREATE_DEPARTMENT
                            )
                        );

                    Route::patch('{id}', action: UpdateDepartmentController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::EDIT_DEPARTMENT
                            )
                        );

                    Route::delete('{id}', DeleteDepartmentController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::DELETE_DEPARTMENT
                            )
                        );

                });

            Route::prefix('exams')
                ->middleware([
                    RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                ])
                ->group(function () {

                    Route::get('', GetExamsController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::LIST_EXAM
                            )
                        );

                    Route::get('schedule', GetExamsScheduleController::class);

                    Route::get('{id}', GetExamController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::LIST_EXAM
                            )
                        );

                    Route::post('', CreateExamController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::CREATE_EXAM
                            )
                        );

                    Route::post('{id}/students', AssignMarkToStudentController::class);

                    Route::patch('{id}/students', UpdateStudentExamMarkController::class);

                    Route::patch('{id}', UpdateExamController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::EDIT_EXAM
                            )
                        );

                    Route::delete('{id}', DeleteExamController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::DELETE_EXAM
                            )
                        );

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
                // ->middleware(
                //     [
                //         RolesEnum::oneRoleOnlyMiddleware(RolesEnum::ADMIN),
                //     ]
                // )
                ->group(function () {

                    Route::get('', GetLecturesController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::LIST_LECTURE
                            )
                        );

                    Route::get('{id}', GetLectureController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::SHOW_LECTURE
                            )
                        );

                    Route::post('', CreateLectureController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::CREATE_LECTURE
                            )
                        );

                    Route::patch('{id}', UpdateLectureController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::EDIT_LECTURE
                            )
                        );

                    Route::delete('{id}', DeleteCourseController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::DELETE_LECTURE
                            )
                        );

                });

            Route::prefix('open-course-registerations')
                ->group(function () {

                    Route::get('', GetOpenCourseRegisterationsController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::LIST_OPEN_COURSE_REGISTERATION
                            )
                        );

                    Route::get('list', GetOpenCourseRegisterationsListController::class);

                    // Route::post('', OpenCourseForRegisterationController::class)
                    //     ->middleware(
                    //         RolesEnum::oneOfRolesMiddleware(RolesEnum::ADMIN, RolesEnum::COURSES_REGISTERER)
                    //     );

                    Route::post('', CreateOpenCourseRegisterationController::class)
                        ->middleware(
                            PermissionsEnum::oneOfPermissionsMiddleware(
                                PermissionsEnum::CREATE_OPEN_COURSE_REGISTERATION
                            )
                        );

                    Route::post('{id}/teachers', AssignTeacherToOpenCourseController::class);

                    Route::delete('{id}/teachers', UnAssignTeacherFromOpenCourseController::class);

                    Route::delete('{id}', UnRegisterOpenCourseController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::DELETE_OPEN_COURSE_REGISTERATION
                            )
                        );

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

                ->group(function () {

                    // Route::get('paginated', GetTeachersPaginatedController::class);

                    Route::get('', GetTeachersController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::LIST_TEACHER
                            )
                        );

                    Route::get('list', GetTeachersListController::class);

                    Route::get('{id}', GetTeacherController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::SHOW_TEACHER
                            )
                        );

                    Route::post('', CreateTeacherController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::CREATE_TEACHER
                            )
                        );

                    Route::patch('{id}', UpdateTeacherController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::EDIT_TEACHER
                            )
                        );

                    Route::delete('{id}', DeleteTeacherController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::DELETE_TEACHER
                            )
                        );

                    Route::delete('', DeleteTeachersController::class)
                        ->middleware(
                            PermissionsEnum::onePermissionOnlyMiddleware(
                                PermissionsEnum::DELETE_TEACHER
                            )
                        );

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

        Route::prefix('open-course-registerations')
            ->group(function () {

                Route::get('', action: GetOpenCoursesThisSemesterController::class)
                    ->middleware([
                        PermissionsEnum::onePermissionOnlyMiddleware(
                            PermissionsEnum::LIST_STUDENT_OPEN_COURSE_REGISTERATION
                        ),
                    ]);

                Route::get('schedule', GetOpenCoursesScheduleController::class);

                Route::get('marks', GetCoursesMarksController::class)
                    ->middleware([
                        PermissionsEnum::onePermissionOnlyMiddleware(
                            PermissionsEnum::LIST_STUDENT_OPEN_COURSE_REGISTERATION_MARKS
                        ),
                    ]);

                Route::get('marks/this-semester', GetCoursesMarksThisSemesterController::class)
                    ->middleware([
                        PermissionsEnum::onePermissionOnlyMiddleware(
                            PermissionsEnum::LIST_STUDENT_OPEN_COURSE_REGISTERATION_MARKS_THIS_SEMESTER
                        ),
                    ]);

                Route::get('registered-courses/this-semester', GetStudentRegisteredOpenCoursesThisSemesterController::class)
                    ->middleware([
                        PermissionsEnum::onePermissionOnlyMiddleware(
                            PermissionsEnum::LIST_STUDENT_OPEN_COURSE_REGISTERATION_THIS_SEMESTER
                        ),
                    ]);

                Route::post('', RegisterInOpenCoursesController::class)
                    ->middleware([
                        PermissionsEnum::onePermissionOnlyMiddleware(
                            PermissionsEnum::CREATE_STUDENT_OPEN_COURSE_REGISTERATION
                        ),
                    ]);

                Route::post('{id}', RegisterInOpenCourseController::class)
                    ->middleware([
                        PermissionsEnum::onePermissionOnlyMiddleware(
                            PermissionsEnum::CREATE_STUDENT_OPEN_COURSE_REGISTERATION
                        ),
                    ]);

                Route::delete('{id}', UnRegisterFromOpenCourseController::class)
                    ->middleware([
                        PermissionsEnum::onePermissionOnlyMiddleware(
                            PermissionsEnum::DELETE_STUDENT_OPEN_COURSE_REGISTERATION
                        ),
                    ]);

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
