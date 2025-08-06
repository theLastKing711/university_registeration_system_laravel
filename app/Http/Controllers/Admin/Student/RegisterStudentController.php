<?php

namespace App\Http\Controllers\Admin\Student;

use App\Data\Admin\Student\RegisterStudent\Request\RegisterStudentRequestData;
use App\Data\Shared\Swagger\Request\JsonRequestBody;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Enum\Auth\RolesEnum;
use App\Facades\CloudUploadService;
use App\Http\Controllers\Controller;
use App\Models\TemporaryUploadedImages;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use OpenApi\Attributes as OAT;

class RegisterStudentController extends Controller
{
    #[OAT\Post(path: '/admins/students', tags: ['adminsStudents'])]
    #[JsonRequestBody(RegisterStudentRequestData::class)]
    #[SuccessNoContentResponse]
    public function __invoke(RegisterStudentRequestData $request)
    {

        /** @var TemporaryUploadedImages $temporary_uploaded_profile_picture */
        $temporary_uploaded_profile_picture =
            TemporaryUploadedImages::firstWhere(
                'id',
                $request->temporary_profile_picture_id
            );

        DB::transaction(function () use ($request, $temporary_uploaded_profile_picture) {

            $student = new User;

            $student->department_id = $request->department_id;
            $student->national_id = $request->national_id;
            $student->birthdate = $request->birthdate;
            $student->enrollment_date = $request->enrollment_date;
            $student->phone_number = $request->phone_number;
            $student->name = $request->name;
            $student->password = $request->password;

            $student->save();

            $student->assignRole(RolesEnum::STUDENT);

            $student
                ->medially()
                ->create([
                    'file_url' => $temporary_uploaded_profile_picture->file_url,
                    'file_name' => $temporary_uploaded_profile_picture->file_name,
                    'file_type' => $temporary_uploaded_profile_picture->file_type,
                    'size' => $temporary_uploaded_profile_picture->size,
                    'collection_name' => $temporary_uploaded_profile_picture->collection_name,
                    'thumbnail_url' => $temporary_uploaded_profile_picture->thumbnail_url,
                ]);

            $temporary_uploaded_profile_picture
                ->delete();

            $student
                ->uploadSchoolFiles(
                    $request->school_files_ids_to_add,
                );

            CloudUploadService::destroy(
                $temporary_uploaded_profile_picture->file_name
            );

        });

    }
}
