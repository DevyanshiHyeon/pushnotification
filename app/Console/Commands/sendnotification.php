<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class sendnotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Will send Notification';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $notifications = DB::table('messages')
            ->where('send_time', '=', now()->format('H:i'))
            ->where('is_active', '1')
            ->inRandomOrder()
            ->limit(1)
            ->get();
        $delete_failed_record = DB::table('devices')
            ->where('last_notification_status', '=', 'failed')
            ->delete();
        foreach ($notifications as $notification) {
            $tokens = DB::table('devices')->orderBy('created_at', 'desc')->pluck('token')->toArray();
            $serverKey = env('FCM_SERVER_KEY');
            $headers = [
                'Authorization' => 'key=' . $serverKey,
                'Content-Type' => 'application/json',
            ];
            $url = 'https://fcm.googleapis.com/fcm/send';
            foreach ($tokens as $t) {
                $data = [
                    'to' => $t,
                    'notification' => [
                        'title' => $notification->title,
                        'body' => $notification->message,
                    ],
                    'data' => [
                        'title' => $notification->title,
                        'body' => $notification->message,
                    ]
                ];

                $response = Http::withHeaders($headers)->post($url, $data);
                $responseData = json_decode($response->getBody(), true);
                if ($response->getStatusCode() == 200 && $responseData['success'] == 1 && $responseData['failure'] == 0) {
                    // Update the notification status in the database
                    DB::table('devices')->where('token', $t)->update(['last_notification_status' => 'sent', 'last_notification_time' => Carbon::now('Asia/Kolkata')]);
                } elseif ($response->getStatusCode() == 200 && $responseData['success'] == 0 && $responseData['failure'] == 1) {
                    // Update the notification status in the database
                    DB::table('devices')->where('token', $t)->update(['last_notification_status' => 'failed', 'last_notification_time' => Carbon::now('Asia/Kolkata')]);
                } else {
                    // Log the error message
                    Log::error('Failed to send notification to ' . $t . ': ' . $response->getBody());
                }
            }
            return $response->json();
        }
    }
}
