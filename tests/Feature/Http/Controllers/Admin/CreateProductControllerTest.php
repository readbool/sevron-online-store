<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\Admin;

use Illuminate\Support\Arr;
use Tests\TestCase;

final class CreateProductControllerTest extends TestCase
{
    public function testAdminCreateProductValidationFailed(): void
    {
        $this->withoutMiddleware();

        $response = $this->postJson(
            \route('api.v1.admin.products.create'),
            [],
            [
                'Accept' => 'application/json',
            ]
        );

        $decodedResponse = \json_decode(
            $response->decodeResponseJson()->json,
            true,
            512,
            JSON_THROW_ON_ERROR
        );

        self::assertNotEmpty($decodedResponse['errors'] ?? []);
    }

    public function testAdminCreateProductSuccess(): void
    {
        $this->withoutMiddleware();

        $response = $this->postJson(
            \route('api.v1.admin.products.create'),
            [
                'name' => 'test product on test',
                'detail' => 'this is a detail',
                'sku' => '091234567',
                'price'=> '20',
            ],
            [
                'Accept' => 'application/json',
            ]
        );

        $decodedResponse = \json_decode(
            $response->decodeResponseJson()->json,
            true,
            512,
            JSON_THROW_ON_ERROR
        );

        self::assertTrue($decodedResponse['success']);
        self::assertEquals('091234567', Arr::get($decodedResponse, 'data.sku'));
    }
}
