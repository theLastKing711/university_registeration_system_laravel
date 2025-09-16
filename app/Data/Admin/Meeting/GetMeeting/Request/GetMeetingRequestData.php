<?php

namespace App\Data\Admin\Meeting\GetMeeting\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminMeetingGetMeetingRequestGetMeetingRequestData')]
class GetMeetingRequestData extends Data
{
    public function __construct(
        #[
            OAT\PathParameter(
                parameter: 'adminsGetMeetingResponsePathParameterData', // the name used in ref
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
