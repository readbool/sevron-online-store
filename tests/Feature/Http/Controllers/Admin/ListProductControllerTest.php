<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\Admin;

use Illuminate\Support\Arr;
use Tests\TestCase;

final class ListProductControllerTest extends TestCase
{
    public function testAdminListProducts(): void
    {
        $this->withoutMiddleware();

        $response = $this->getJson(
            \route('api.v1.admin.products.list'),
            [
                'Accept' => 'application/json',
                'Authorization' => '1234',
            ]
        );

        $decodedResponse = \json_decode(
            $response->decodeResponseJson()->json,
            true,
            512,
            JSON_THROW_ON_ERROR
        );

        self::assertTrue(Arr::get($decodedResponse, 'success'));
        self::assertNotNull(Arr::get($decodedResponse, 'data.data'));
    }
}
