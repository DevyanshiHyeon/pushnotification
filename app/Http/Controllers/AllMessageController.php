<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AllMessage;
use DataTables;
use App\Models\Application;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class AllMessageController extends Controller
{
    public function index($application_id)
    {
        return view('all_message.index');
    }
    public function all_message_list(Request $request, $application_id)
    {
        if ($request->ajax()) {
            $all_msgs = AllMessage::where('application_id', $application_id)->whereNull('perent_id')->get();
            $data = [];
            $i = 1;
            foreach ($all_msgs as $msg) {
                $data[] = [
                    'sr_no' => $i++,
                    'title' => $msg->title,
                    'description' => $msg->message,
                    'action' => '<a href="' . url('child-msg/' . $application_id . '/' . $msg->id) . '" class="btn btn-sm btn-dark">Add message</a>'
                ];
            }
            return Datatables::of($data)->rawColumns(['action'])->make(true);
        }
    }
    public function store($application_id, Request $request)
    {
        if ($request->perentmsg_id) {
            $perent_msg = AllMessage::find($request->perentmsg_id);
            AllMessage::create([
                'application_id' => $application_id,
                'title' => $request->title,
                'message' => $request->message,
                'send_time' => $perent_msg->send_time,
                'perent_id' => $request->perentmsg_id
            ]);
            return redirect()->back()->with('success', 'message created successfully.');
        } else {
            AllMessage::create([
                'application_id' => $application_id,
                'title' => $request->title,
                'message' => $request->message,
                'send_time' => $request->time
            ]);
            return redirect()->back()->with('success', 'message created successfully.');
        }
    }
    public function child_msg($application_id, $perentmsg_id)
    {
        return view('all_message.child_msg', compact('application_id', 'perentmsg_id'));
    }
    public function child_msg_list($application_id, $perentmsg_id,Request $request)
    {
        if ($request->ajax()) {
            $all_msgs = AllMessage::where('application_id', $application_id)
            ->where('perent_id',$perentmsg_id)
            ->get();
            $data = [];
            $i = 1;
            foreach ($all_msgs as $msg) {
                $data[] = [
                    'sr_no' => $i++,
                    'title' => $msg->title,
                    'description' => $msg->message,
                    // 'action' => '<a href="' . url('child-msg/' . $application_id . '/' . $msg->id) . '" class="btn btn-sm btn-dark">Add message</a>'
                ];
            }
            return Datatables::of($data)->rawColumns(['action'])->make(true);
        }
    }
    public function send_instant_notification(Request $request,$application_id)
    {
        if(isset($request->is_instant)){
            $msg = AllMessage::create([
                'application_id' => $application_id,
                'title' => $request->title,
                'message' => $request->message,
                'send_time' => now()->format('H:i'),
                'is_instant' => true,
            ]);
            $tokens = DB::table('all_tokens')->where('application_id',$application_id)->orderBy('created_at', 'desc')->pluck('token')->toArray();
            $app_serverkey = Application::find($application_id)->server_key;
            $serverKey = $app_serverkey;
            $headers = [
                'Authorization' => 'key=' . $serverKey,
                'Content-Type' => 'application/json',
            ];
            $url = 'https://fcm.googleapis.com/fcm/send';
            foreach ($tokens as $t) {
                $data = [
                    'to' => $t,
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
                    DB::table('all_tokens')->where('token', $t)->update(['last_notification_status' => 'sent', 'last_notification_time' => Carbon::now('Asia/Kolkata')]);
                } elseif ($response->getStatusCode() == 200 && $responseData['success'] == 0 && $responseData['failure'] == 1) {
                    // Update the notification status in the database
                    DB::table('all_tokens')->where('token', $t)->update(['last_notification_status' => 'failed', 'last_notification_time' => Carbon::now('Asia/Kolkata')]);
                } else {
                    // Log the error message
                    Log::error('Failed to send notification to ' . $t . ': ' . $response->getBody());
                }
            }
            // return $response->json();
            return redirect('/message')->with('message',"Message sent Successfully ");
        }
        $msg = Message::create([
            'title' => $request->title,
            'message' => $request->message,
            'send_time' => $request->time,
        ]);
        return redirect('/message')->with('message',"Message Added Successfully ");
    }
}
