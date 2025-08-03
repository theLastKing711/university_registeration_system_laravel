<?php

namespace Tests\Feature\Admin\Student;

use App\Data\Admin\Student\GraduateStudent\Request\GraduateStudentRequestData;
use App\Data\Admin\Student\RegisterStudent\Request\RegisterStudentRequestData;
use App\Data\Admin\Student\UpdateStudent\Request\UpdateStudentRequestData;
use App\Data\Admin\Student\UploadStudentProfile\Request\UploadStudentProfilePictureRequestData;
use App\Data\Admin\Student\UploadStudentSchoolFiles\Request\UploadStudentSchoolFilesRequestData;
use App\Enum\FileUploadDirectory;
use App\Models\Department;
use App\Models\Media;
use App\Models\TemporaryUploadedImages;
use App\Models\User;
use CloudinaryLabs\CloudinaryLaravel\CloudinaryEngine;
use CloudinaryLabs\CloudinaryLaravel\Model\Media as ModelMedia;
use Database\Seeders\AcademicYearSemesterSeeder;
use Database\Seeders\DepartmentSeeder;
use Illuminate\Http\UploadedFile;
use PHPUnit\Framework\Attributes\Test;
use Tests\Feature\Admin\Abstractions\AdminTestCase;
use Tests\Feature\Admin\Traits\CloudUploadServiceMocks;

class StudentTest extends AdminTestCase
{
    use CloudUploadServiceMocks;

    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->withRoutePaths(
                'students'
            );

        $this->
            seed([
                AcademicYearSemesterSeeder::class,
                DepartmentSeeder::class,
            ]);

    }

    #[Test]
    public function get_student_with_200_response(): void
    {

        $student =
            User::factory()
                ->withStudentRole()
                ->has(
                    Media::factory()
                        ->withCollectionName(
                            FileUploadDirectory::USER_PROFILE_PICTURE
                        ),
                    'medially'
                )
                ->create();

        $response =
            $this
                ->withRoutePaths(
                    $student->id
                )
                ->getJsonData();

        $response->assertStatus(200);

    }

    #[Test]
    public function register_student_with_200_response(): void
    {

        $department_id =
            Department::query()
                ->first()
                ->id;

        $admin = User::factory()
            ->withStudentRole()
            ->has(
                TemporaryUploadedImages::factory()
                    ->withCollectionName(FileUploadDirectory::USER_PROFILE_PICTURE)
            )
            ->create();

        $new_student_temporary_profile_picture =
             $admin
                 ->temporaryUploadedImages()
                 ->first();

        $register_student_request =
            new RegisterStudentRequestData(
                $department_id,
                fake()->randomNumber(6, true),
                '1998-01-01',
                '214-01-10',
                fake()->phoneNumber(),
                fake()->name(),
                fake()->password(),
                $new_student_temporary_profile_picture->id
            );

        $this
            ->mockDestroy(
                $new_student_temporary_profile_picture
                    ->file_name
            );

        $response =
            $this
                ->postJsonData(
                    $register_student_request
                        ->toArray()
                );

        $response->assertStatus(200);

        $this
            ->assertDatabaseHas(
                User::class,
                [
                    'department_id' => $register_student_request->department_id,
                    'national_id' => $register_student_request->national_id,
                    'birthDate' => $register_student_request->birthdate,
                    'enrollment_date' => $register_student_request->enrollment_date,
                    'phone_number' => $register_student_request->phone_number,
                    'name' => $register_student_request->name,
                ]
            );

        $this
            ->assertDatabaseHas(
                Media::class,
                [
                    'file_url' => $new_student_temporary_profile_picture->file_url,
                    'file_name' => $new_student_temporary_profile_picture->file_name,
                    'file_type' => $new_student_temporary_profile_picture->file_type,
                    'size' => $new_student_temporary_profile_picture->size,
                    'collection_name' => $new_student_temporary_profile_picture->collection_name,
                    'thumbnail_url' => $new_student_temporary_profile_picture->thumbnail_url,
                ]
            );

        $this
            ->assertDatabaseMissing(
                TemporaryUploadedImages::class,
                [
                    'id' => $new_student_temporary_profile_picture->id,
                ]
            );

    }

    #[Test]
    public function update_student_with_200_response(): void
    {

        $department_id =
            Department::query()
                ->first()
                ->id;

        $admin_uploaded_school_files_count =
            4;

        $admin = User::factory()
            ->has(
                TemporaryUploadedImages::factory()
                    ->profilePicture(),
                'temporaryUploadedProfilePicture'
            )
            ->has(
                TemporaryUploadedImages::factory($admin_uploaded_school_files_count)
                    ->schoolFiles(),
                'temporaryUploadedImages'
            )
            ->create();

        $temporary_proflie_picture_uploaded_by_admin =
                $admin
                    ->temporaryUploadedProfilePicture;

        $temporary_school_files_uploaded_by_admin =
                $admin
                    ->temporaryUploadedSchoolFiles;

        $student_school_files_count =
                4;

        /** @var User $new_students */
        $new_student =
            User::factory()
                ->withStudentRole()
                ->withProfilePicture()
                ->withSchoolFiles($student_school_files_count)
                ->create();

        $school_files_count_to_delete =
                3;

        $school_files_to_delete =
            $new_student
                ->schoolFiles
                ->take($school_files_count_to_delete);

        $student_profile_picture =
            $new_student
                ->profilePicture;

        $this
            ->mockDestroy(
                public_id: $temporary_proflie_picture_uploaded_by_admin
                    ->file_name
            );

        $temporary_school_files_uploaded_by_admin
            ->pluck('file_name')
            ->each(
                fn ($file_name) => $this->mockDestroy($file_name)
            );

        $update_student_request =
            new UpdateStudentRequestData(
                $department_id,
                fake()->randomNumber(6, true),
                '1998-01-01',
                '214-01-10',
                '214-01-10',
                fake()->phoneNumber(),
                fake()->name(),
                fake()->password(),
                $temporary_proflie_picture_uploaded_by_admin->id,
                school_files_ids_to_add: $temporary_school_files_uploaded_by_admin->pluck('id'),
                school_files_ids_to_delete: $school_files_to_delete->pluck('id'),
                id: $new_student->id
            );

        $response =
            $this
                ->withRoutePaths(
                    $new_student->id
                )
                ->patchJsonData(
                    $update_student_request
                        ->toArray()
                );

        $response->assertStatus(200);

        $this
            ->assertDatabaseHas(
                User::class,
                [
                    'id' => $new_student->id,
                    'department_id' => $update_student_request->department_id,
                    'national_id' => $update_student_request->national_id,
                    'birthDate' => $update_student_request->birthdate,
                    'enrollment_date' => $update_student_request->enrollment_date,
                    'phone_number' => $update_student_request->phone_number,
                    'name' => $update_student_request->name,
                ]
            );

        $this
            ->assertDatabaseMissing(
                TemporaryUploadedImages::class,
                [
                    'id' => $temporary_proflie_picture_uploaded_by_admin->id,
                ]
            );

        $this
            ->assertDatabaseHas(
                Media::class,
                [
                    'medially_id' => $new_student->id,
                    'file_name' => $temporary_proflie_picture_uploaded_by_admin->file_name,
                    'file_url' => $temporary_proflie_picture_uploaded_by_admin->file_url,
                    'collection_name' => FileUploadDirectory::USER_PROFILE_PICTURE,

                ]
            );

        $this
            ->assertDatabaseMissing(
                Media::class,
                [
                    'file_name' => $student_profile_picture->file_name,
                    'file_url' => $student_profile_picture->file_url,
                ]
            );

        $this
            ->assertDatabaseCount(
                Media::class,
                $student_school_files_count
                        +
                        1
                        +
                        $admin_uploaded_school_files_count
                        -
                        $school_files_count_to_delete
            );

        $school_files_to_delete
            ->each(fn (ModelMedia $student_school_file) => $this
                ->assertDatabaseMissing(
                    Media::class,
                    [
                        'id' => $student_school_file->id,
                        'file_name' => $student_school_file->file_name,
                        'file_url' => $student_school_file->file_url,
                    ]
                )
            );

        $temporary_school_files_uploaded_by_admin
            ->each(fn ($temporary_school_file) => $this
                ->assertDatabaseMissing(
                    TemporaryUploadedImages::class,
                    [
                        'id' => $temporary_school_file->id,
                        'file_name' => $temporary_school_file->file_name,
                        'file_url' => $temporary_school_file->file_url,
                    ]
                )
            );

        $school_files_to_delete
            ->each(fn (ModelMedia $student_school_file) => $this
                ->assertDatabaseMissing(
                    Media::class,
                    [
                        'id' => $student_school_file->id,
                        'file_name' => $student_school_file->file_name,
                        'file_url' => $student_school_file->file_url,
                    ]
                )
            );

        $temporary_school_files_uploaded_by_admin
            ->each(fn ($student_school_file) => $this
                ->assertDatabaseHas(
                    Media::class,
                    [
                        'medially_id' => $new_student->id,
                        'file_name' => $student_school_file->file_name,
                        'file_url' => $student_school_file->file_url,
                        'collection_name' => FileUploadDirectory::SCHOOL_FILES,
                    ]
                )
            );

    }

    #[Test]
    public function delete_student_with_200_response(): void
    {

        $new_student =
             User::factory()
                 ->withStudentRole()
                 ->create();

        $response =
            $this
                ->withRoutePaths(
                    $new_student->id
                )
                ->deleteJsonData();

        $response->assertStatus(200);

        $this
            ->assertDatabaseMissing(
                User::class,
                [
                    'id' => $new_student->id,
                ]
            );

    }

    #[Test]
    public function graduate_student_with_200_response(): void
    {

        $new_student =
             User::factory()
                 ->withStudentRole()
                 ->create();

        $graduate_student_request =
            new GraduateStudentRequestData(
                '2018-01-1'
            );

        $response =
            $this
                ->withRoutePaths(
                    $new_student->id,
                    'graduation'
                )
                ->patchJsonData(
                    $graduate_student_request
                        ->toArray()
                );

        $response->assertStatus(200);

        $this
            ->assertDatabaseHas(
                User::class,
                [
                    'id' => $new_student->id,
                    'graduation_date' => $graduate_student_request->graduation_date,
                ]
            );

    }

    #[Test]
    public function upload_student_profile_picture_with_201_response()
    {

        $upload_mock_response =
             $this
                 ->mockUpload();

        $file =
            UploadedFile::fake()
                ->create(
                    'test_file.jpg',
                    800
                );

        $upload_student_profile_picture_request =
            new UploadStudentProfilePictureRequestData(
                file: $file
            );

        $response =
            $this
                ->withRoutePaths('profile-picture')
                ->postJsonData(
                    $upload_student_profile_picture_request
                        ->toArray()
                );

        $response->assertStatus(201);

        $this
            ->assertDatabaseHas(
                TemporaryUploadedImages::class,
                [
                    'uploadable_id' => $this->admin->id,
                    'uploadable_type' => User::class,
                    'public_id' => $upload_mock_response[CloudinaryEngine::PUBLIC_ID],
                    'file_name' => $upload_mock_response[CloudinaryEngine::ORIGINAL_FILENAME],
                    'file_url' => $upload_mock_response[CloudinaryEngine::SECURE_URL],
                    'size' => $upload_mock_response[CloudinaryEngine::BYTES],
                    'file_type' => $upload_mock_response[CloudinaryEngine::RESOURCE_TYPE],
                    'collection_name' => FileUploadDirectory::USER_PROFILE_PICTURE,
                    'thumbnail_url' => $upload_mock_response['eager'][0][CloudinaryEngine::SECURE_URL],
                ]
            );

    }

    #[Test]
    public function delete_student_profile_picture_with_200_response()
    {

        $student =
             User::factory()
                 ->withStudentRole()
                 ->withProfilePicture()
                 ->create();

        /** @var Media $student_profile_picture */
        $student_profile_picture =
            $student
                ->medially
                ->first();

        $this
            ->mockDestroy(
                $student_profile_picture
                    ->file_name
            );

        $response =
            $this
                ->withRoutePaths(
                    $student->id,
                    'profile-picture',
                    $student_profile_picture->id
                )
                ->deleteJsonData();

        $response->assertStatus(200);

        $this
            ->assertDatabaseMissing(
                Media::class,
                [
                    'id' => $student_profile_picture->id,
                ]
            );

    }

    #[Test]
    public function upload_school_files_with_201_response()
    {

        $school_files_count =
            2;

        $files_request =
            collect([])
                ->range(1, $school_files_count)
                ->map(fn ($file) => UploadedFile::fake()
                    ->create(
                        fake()->imageUrl(),
                        fake()->numberBetween(800, 1000)
                    )
                );

        $upload_student_profile_picture_request =
            new UploadStudentSchoolFilesRequestData(
                files: $files_request
            );

        $upload_mock_response =
             $this
                 ->mockUpload(
                     $files_request->count()
                 );

        $response =
            $this
                ->withRoutePaths(
                    'school-files'
                )
                ->postJsonData(
                    $upload_student_profile_picture_request
                        ->toArray()
                );

        $response->assertStatus(200);

        $upload_mock_response
            ->each(fn ($resposne) => $this
                ->assertDatabaseHas(
                    TemporaryUploadedImages::class,
                    [
                        'uploadable_id' => $this->admin->id,
                        'uploadable_type' => User::class,
                        'public_id' => $resposne[CloudinaryEngine::PUBLIC_ID],
                        'file_name' => $resposne[CloudinaryEngine::ORIGINAL_FILENAME],
                        'file_url' => $resposne[CloudinaryEngine::SECURE_URL],
                        'size' => $resposne[CloudinaryEngine::BYTES],
                        'file_type' => $resposne[CloudinaryEngine::RESOURCE_TYPE],
                        'collection_name' => FileUploadDirectory::SCHOOL_FILES,
                        'thumbnail_url' => $resposne['eager'][0][CloudinaryEngine::SECURE_URL],
                    ]
                )
            );

    }
}
