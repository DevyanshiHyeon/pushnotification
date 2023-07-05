<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function store(Request $request)
    {
        $device_info = Device::where('token', '=', $request->token)->first();
        $current_date = $currentTime = Carbon::now()->toDateString();
        if ($device_info === null) {
            $user_data = [
                'date' => $current_date,
                'count' => 0
            ];
            Device::create([
                'token' => $request->token,
                'is_used' => 1,
                'notification_info' => json_encode($user_data),
            ]);
            return response()->json(['Success' => 'Device Token Enter Successfully']);
        } else {
            $old_user_data = json_decode($device_info->notification_info, true);
            if ($old_user_data['date'] !== $current_date) {
                $new_user_data = [
                    'date' => $current_date,
                    'count' => $old_user_data['count'] + 1
                ];
                $user_data = array_push($new_user_data, $old_user_data);
            } elseif ($old_user_data['date'] == $current_date) {
                $user_data = [
                    'date' => $current_date,
                    'count' => $old_user_data['count'] + 1
                ];
            }
            $device_info->update([
                'is_used' => $device_info->is_used + 1,
                'notification_info' => json_encode($user_data),
            ]);
            return response()->json(['Success' => 'Device Token Count Increse Successfully']);
        }
    }
}
