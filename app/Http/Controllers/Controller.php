<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    //Add this method to the Controller class
    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 1
        ], 200);
    }

    // Fungsi untuk mengembalikkan response
    function sendResponse($code = null, $status, $message, $data = null)
    {
        $response = [];

        if ($code != null) {
            $response['code'] = $code;
        }
        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];

        return $response;
    }
}
