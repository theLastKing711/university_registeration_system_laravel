<?php

namespace App\Http\Controllers\Admin\Student;

use App\Data\Admin\Student\UpdateStudent\Request\UpdateStudentRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Facades\MediaService;
use App\Http\Controllers\Admin\Student\Abstract\StudentController;
use App\Models\TemporaryUploadedImages;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
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

            $user
                ->update([
                    'department_id' => $request->department_id,
                    'national_id' => $request->national_id,
                    'birthdate' => $request->birthdate,
                    'enrollment_date' => $request->enrollment_date,
                    'graduation_date' => $request->graduation_date,
                    'phone_number' => $request->phone_number,
                    'name' => $request->name,
                    'password' => $request->password,
                ]);

            /** @var TemporaryUploadedImages $temporary_uploaded_profile_picture */
            $temporary_uploaded_profile_picture =
                TemporaryUploadedImages::query()
                    ->firstWhere(
                        'id',
                        $request->temporary_profile_picture_id
                    );

            $user
                ->updateProfilePicture(
                    $temporary_uploaded_profile_picture
                );

            MediaService::destroyTemporaryImageById(
                $request->temporary_profile_picture_id
            );

            /** @var Collection<TemporaryUploadedImages> $temporary_uploaded_school_files */
            $temporary_uploaded_school_files =
                TemporaryUploadedImages::query()
                    ->whereIn(
                        'id',
                        $request->school_files_ids_to_add
                    )
                    ->get();

            $temporary_uploaded_school_files
                ->each(fn ($file) => MediaService::destroyTemporaryImageById(
                    $file->id
                )
                );

            $user
                ->updateSchoolFiles(
                    $temporary_uploaded_school_files,
                    $request->school_files_ids_to_delete
                );

        });

    }
}
