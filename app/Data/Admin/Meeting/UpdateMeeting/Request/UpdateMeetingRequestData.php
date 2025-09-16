<?php

namespace App\Data\Admin\Meeting\UpdateMeeting\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminMeetingUpdateMeetingRequestUpdateMeetingRequestData')]
class UpdateMeetingRequestData extends Data
{
    public function __construct(
        #[
            OAT\PathParameter(
                parameter: 'adminsUpdateMeetingResponsePathParameterData', // the name used in ref
                name: 'id',
                schema: new OAT\Schema(
                    type: 'integer',
                ),
            ),
            FromRouteParameter('id'),
            Exists('meetings', 'id')
        ]
        public int $id,
    ) {}

}
