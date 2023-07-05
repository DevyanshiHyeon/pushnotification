<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    
    public function test(Request $request)
    {
        $serverKey = $request->server_key;
        $headers = [
            'Authorization' => 'key=' . $serverKey,
            'Content-Type' => 'application/json',
        ];
        $url = 'https://fcm.googleapis.com/fcm/send';

        $data = [
            'to' => $request->token,
            'notification' => [
                'title' => $request->title,
                'body' => $request->message,
            ],
            'data' => [
                'title' => $request->title,
                'body' => $request->message,
            ]
        ];

        $response = Http::withHeaders($headers)->post($url, $data);
        $responseData = json_decode($response->getBody(), true);
        if ($response->getStatusCode() == 200 && $responseData['success'] == 1 && $responseData['failure'] == 0) {
            // Update the notification status in the database
            // $responseData
            return $responseData;
        } elseif ($response->getStatusCode() == 200 && $responseData['success'] == 0 && $responseData['failure'] == 1) {
            // Update the notification status in the database
            return $responseData;
        } else {
            // Log the error message
            return $responseData;
        }
    }
}
