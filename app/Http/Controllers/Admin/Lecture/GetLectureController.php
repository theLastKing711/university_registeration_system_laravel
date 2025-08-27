<?php

namespace App\Http\Controllers\Admin\Lecture;

use App\Data\Admin\Lecture\GetLecture\Request\GetLectureRequestData;
use App\Data\Admin\Lecture\GetLecture\Response\GetLectureResponseData;
use App\Data\Shared\Swagger\Response\SuccessListResponse;
use App\Http\Controllers\Admin\Lecture\Abstract\LectureController;
use App\Models\Lecture;
use OpenApi\Attributes as OAT;

class GetLectureController extends LectureController
{
    #[OAT\Get(path: '/admins/lectures', tags: ['adminsLectures'])]
    #[SuccessListResponse(GetLectureResponseData::class)]
    public function __invoke(GetLectureRequestData $request)
    {
        return GetLectureResponseData::from(
            Lecture::query()
                ->with('attendances')
                ->firstWhere(
                    'id',
                    $request->id
                )
        );
    }
}
