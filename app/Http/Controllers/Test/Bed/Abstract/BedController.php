<?php

namespace App\Http\Controllers\Test\Bed\Abstract;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OAT;

#[
    OAT\PathItem(
        path: '/tests/beds/{id}',
        parameters: [
            new OAT\PathParameter(
                ref: '#/components/parameters/testIdPathParameter',
            ),
        ],
    ),
]
class BedController extends Controller
{

    #[OAT\Get(path: '/tests/beds', tags: ['testsBeds'])]
    public function __invoke()
    {

    }
}
