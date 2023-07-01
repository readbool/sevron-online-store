<?php

declare(strict_types=1);


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

abstract class AbstractBaseController extends Controller
{
    public function sendResponse($result, $message, ?int $statusCode = Response::HTTP_OK): JsonResponse
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, $statusCode);
    }

    public function sendError($error, $errorMessages = [], $code = 404): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if(empty($errorMessages) === true){
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
