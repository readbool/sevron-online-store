<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Authentication;

use App\Http\Controllers\API\AbstractBaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class LoginController extends AbstractBaseController
{
    public function __invoke(Request $request): JsonResponse
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password]) === true){
            $user = Auth::user();

            $success['token'] =  $user->createToken('login')->plainTextToken;

            return $this->sendResponse($success, 'User logged in successfully.');
        }

        return $this->sendError('Unauthorised.', ['error'=> 'Unauthorised']);
    }
}
