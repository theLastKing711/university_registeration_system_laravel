<?php

namespace App\Data\Admin\Admin\PathParameters;

use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;

class AdminIdPathParameterData extends Data
{
    public function __construct(
        #[
            OAT\PathParameter(
                parameter: 'adminsAdminIdPathParameterData', //the name used in ref
                name: 'id',
                schema: new OAT\Schema(
                    type: 'integer',
                ),
            ),
            FromRouteParameter('id'),
            Exists('admins', 'id')
        ]
        public int $id,
    ) {
    }
}
