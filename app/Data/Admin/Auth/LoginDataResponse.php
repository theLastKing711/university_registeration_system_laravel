<?php

namespace App\Data\Admin\Auth;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;

#[Oat\Schema(schema: 'adminLoginResponse')]
class LoginDataResponse extends Data
{
    public function __construct(
        #[OAT\Property(type: 'integer')]
        public int $id,
        #[OAT\Property(type: 'string')]
        public string $name,
        // #[OAT\Property(type: 'string')]
        // public string $email,
        #[OAT\Property(type: 'string')]
        public string $created_at,
    ) {}
}
