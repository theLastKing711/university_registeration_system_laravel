<?php

namespace App\Data\Admin\Lecture\GetLecture\Request;

use App\Models\Lecture;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminLectureGetLectureRequestGetLectureRequestData')]
class GetLectureRequestData extends Data
{
    public function __construct(
        #[
            OAT\PathParameter(
                parameter: 'adminsLectureGetLectureREuqstDataIdPathParameter',
                name: 'id',
                schema: new OAT\Schema(
                    type: 'integer',
                ),
            ),
            FromRouteParameter('id'),
            Exists(Lecture::class, 'id')
        ]
        public int $id,
    ) {}
}
