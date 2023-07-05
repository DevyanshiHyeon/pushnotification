<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;


class MainController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
    public function get_data(Request $request)
    {
        $data = [];
        $i = 1;
        $startDate = DB::table('devices')->orderBy('created_at')->value('created_at'); // Get data for the past 7 days
        $endDate = Carbon::now()->endOfDay();
        // DB::enableQueryLog();
        $records = DB::table('devices')
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%d-%M-%Y") as date'),
                DB::raw('COUNT(CASE WHEN is_used = 1 THEN 1 END) as new_users'),
                DB::raw('COUNT(CASE WHEN is_used > 1 THEN 1 END) as repeated_users'),
                DB::raw('COUNT(CASE WHEN last_notification_status = "sent" THEN 1 ELSE 0 END) as success_count')
            )
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->get();
        foreach ($records as $record) {
            $data[] = [
                'sr_no' => $i++,
                'date' => $record->date,
                'new_use' => $record->new_users,
                'repeated_users' => $record->repeated_users,
                'success_count' => $record->success_count
            ];
        }
        return Datatables::of($data)->make(true);
    }
    public function sendPushNotification(Request $request)
    {
           //demo
           $ip = $request->ip(); // Retrieve the device's IP address from the request
$apiKey = 'https://pushnotification.appomania.co.in/api/secure-folder'; // Replace with your actual API key

$url = "https://api.ipapi.com/{$ip}?access_key={$apiKey}";
$response = file_get_contents($url);
dd($response);
$data = json_decode($response);

$countryCode = $data->country_code;

//demo
        try {
            $serverKey = 'AAAAuIzbAXw:APA91bE3VAMBElAnK9gc9Nd6FWCnQdMSRGbLf5D7KGWgzAWFRa4hVsJm4dOhNvUtaf0LJECOOitZujoCQ8DjvTJAkcVU41fuWESqO_k7dieXsl6sqBkvGMrt0avo7D0XnXkeTdjK-0F9';
            $headers = [
                'Authorization' => 'key=' . $serverKey,
                'Content-Type' => 'application/json',
            ];
            $url = 'https://fcm.googleapis.com/fcm/send';

            $data = [
                'to' => $request->input('token'),
                'notification' => [
                    'title' => $request->input('title'),
                    'body' => $request->input('message'),
                ],
                'data' => [
                    'title' => $request->input('title'),
                    'body' => $request->input('message'),
                ]
                ,'apns'=>[
                    'headers'=>[
                        'apns-expiration'=>"1604750400"
                    ]
                ],
                'android'=>[
                    'ttl'=>'4500s'
                ],
                'webpush'=>[
                    'headers'=>[
                        'TTL'=>"4500"
                    ]
                ]
            ];

            $response = Http::withHeaders($headers)->post($url, $data);

            return $response->json();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
