<?php

namespace App\Http\Controllers\Admin\Lecture;

use App\Data\Admin\Lecture\DeleteLecture\Request\DeleteLectureRequestData;
use App\Data\Shared\Swagger\Response\SuccessNoContentResponse;
use App\Http\Controllers\Admin\Lecture\Abstract\LectureController;
use OpenApi\Attributes as OAT;

class DeleteLectureController extends LectureController
{
    #[OAT\Delete(path: '/admins/lectures/{id}', tags: ['adminsLectures'])]
    #[SuccessNoContentResponse]
    public function __invoke(DeleteLectureRequestData $request) {}
}
