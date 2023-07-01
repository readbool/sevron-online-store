<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Authentication;

use Illuminate\Support\Facades\Auth;

final class LogoutController
{
    public function __invoke()
    {
        Auth::guard('api')->logout();
    }
}
