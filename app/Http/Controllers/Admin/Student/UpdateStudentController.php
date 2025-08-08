<?php

namespace App\Http\Controllers\Admin\Student;

use App\Data\Admin\Student\UpdateStudent\Request\UpdateStudentRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Facades\MediaService;
use App\Http\Controllers\Admin\Student\Abstract\StudentController;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use OpenApi\Attributes as OAT;

class UpdateStudentController extends StudentController
{
    #[OAT\Patch(path: '/admins/students/{id}', tags: ['adminsStudents'])]
    #[JsonRequestBody(UpdateStudentRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(UpdateStudentRequestData $request)
    {

        DB::transaction(function () use ($request) {

            $user =
                User::query()
                    ->firstWhere(
                        'id',
                        $request->id
                    );

            when(
                isset($request->password),
                fn () => $user
                    ->update([
                        'department_id' => $request->department_id,
                        'national_id' => $request->national_id,
                        'birthdate' => $request->birthdate,
                        'enrollment_date' => $request->enrollment_date,
                        'graduation_date' => $request->graduation_date,
                        'phone_number' => $request->phone_number,
                        'name' => $request->name,
                        'password' => $request->password,
                    ]),
                fn () => $user
                    ->update([
                        'department_id' => $request->department_id,
                        'national_id' => $request->national_id,
                        'birthdate' => $request->birthdate,
                        'enrollment_date' => $request->enrollment_date,
                        'graduation_date' => $request->graduation_date,
                        'phone_number' => $request->phone_number,
                        'name' => $request->name,
                    ])
            );

            if (isset($request->temporary_profile_picture_id)) {
                $user
                    ->updateProfilePictureByTemporaryUploadedImageId(
                        $request->temporary_profile_picture_id
                    );

                MediaService::destroyTemporaryImageById(
                    $request->temporary_profile_picture_id
                );

            }

            $user
                ->updateSchoolFiles(
                    $request->school_files_ids_to_add,
                    $request->school_files_ids_to_delete
                );

            MediaService::destroyTemporaryImagesByIds(
                $request
                    ->school_files_ids_to_add
            );

        });

    }
}
