<?php

namespace App\Data\Admin\Lecture\DeleteLecture\Request;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use OpenApi\Attributes as OAT;

#[TypeScript]
#[Oat\Schema(schema: 'AdminLectureDeleteLectureRequestDeleteLectureRequestData')]
class DeleteLectureRequestData extends Data
{
    public function __construct(

    ) {}

}
