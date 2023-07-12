<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\AllMessage;
use App\Models\AllToken;
use App\Models\Application;

class send_noti_dynamicly extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send Notification App Wise';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $notifications = AllMessage::where('send_time', '=', now()->format('H:i'))
        ->where('is_active', true)
        ->where('is_instant', false)
        ->where('sent_instant','!=' ,true)
        ->inRandomOrder()->get();
        $delete_failed_record = AllToken::where('last_notification_status', '=', 'failed')->delete();

        foreach ($notifications as $notification) {
            $application_id = $notification->application_id;
            $serverKey = Application::find($application_id)->server_key;
            $tokens = AllToken::orderBy('created_at', 'desc')->where('application_id',$application_id)->pluck('token')->toArray();
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
                    AllToken::where('token',$t)->where('token', $t)->update(['last_notification_status' => 'sent', 'last_notification_time' => Carbon::now('Asia/Kolkata')]);
                } elseif ($response->getStatusCode() == 200 && $responseData['success'] == 0 && $responseData['failure'] == 1) {
                    AllToken::where('token',$t)->where('token', $t)->update(['last_notification_status' => 'failed', 'last_notification_time' => Carbon::now('Asia/Kolkata')]);
                } else {
                    AllToken::where('token',$t)->where('token', $t)->update(['last_notification_status' => 'failed', 'last_notification_time' => Carbon::now('Asia/Kolkata')]);
                    Log::error('Failed to send notification to ' . $t . ': ' . $response->getBody());
                }
            }
            // return $response->json();
        }
    }
}
