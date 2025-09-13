<?php

namespace App\Data\Admin\Notification\GetNotifications\Response;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[Oat\Schema(schema: 'AdminNotificationGetNotificationsResponseGetNotificationsResponseData')]
class GetNotificationsResponseData extends Data
{
    public function __construct(
        #[OAT\Property]
        public string $messeage,
        #[OAT\Property]
        public ?string $route,
    ) {}
}
