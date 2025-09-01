<?php

namespace App\Data\Admin\Auth;

use OpenApi\Attributes as OAT;
use Spatie\LaravelData\Data;

#[Oat\Schema(schema: 'adminLoginResponse')]
class LoginDataResponse extends Data
{
    public function __construct(
        #[OAT\Property]
        public int $id,
        #[OAT\Property]
        public string $name,
        #[OAT\Property]
        public string $redirect_to,
        // #[OAT\Property(type: 'string')]
        // public string $email,
    ) {}
}
