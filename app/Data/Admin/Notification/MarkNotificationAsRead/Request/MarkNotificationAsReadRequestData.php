<?php

namespace App\Data\Admin\Notification\MarkNotificationAsRead\Request;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminNotificationMarkNotificationAsReadRequestMarkNotificationAsReadRequestData')]
class MarkNotificationAsReadRequestData extends Data
{
    public function __construct(
        #[
            OAT\PathParameter(
                parameter: 'AdminNotificationMarkNotificationAsReadRequestMarkNotificationAsReadRequestDataIdPathParameter',
                name: 'id',
                schema: new OAT\Schema(
                    type: 'string',
                ),
            ),
            FromRouteParameter('id'),
            Exists('notifications', 'id')
        ]
        public string $id,
    ) {}

}
