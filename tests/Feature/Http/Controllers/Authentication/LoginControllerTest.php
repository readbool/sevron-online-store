<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\Authentication;

use App\Models\User;
use Tests\TestCase;

final class LoginControllerTest extends TestCase
{
    public function testLogin(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        $response = $this->postJson(
            route('api.v1.login'),
            [
                'email' => $user->getEmail(),
                'password' => 'password',
            ],
            ['Accept' => 'Application/json']
        );

        $decoded = \json_decode(
            $response->decodeResponseJson()->json,
            true,
            512,
            JSON_THROW_ON_ERROR
        );

        self::assertTrue($decoded['success']);
        self::assertNotNull($decoded['data']['token'] ?? null);
    }
}
