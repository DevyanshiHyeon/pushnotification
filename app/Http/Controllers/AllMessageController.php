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
            $all_msgs = AllMessage::where('application_id', $application_id)->whereNull('perent_id')->orderBy('created_at', 'desc')->get();
            $data = [];$i = 1;
            foreach ($all_msgs as $msg) {
                if($msg->is_instant == true){
                    $status = '<span class="badge bg-label-info">Instant</span>';
                    $action = '<div class="d-flex"><a href="javascript:edit_msg('.$msg->id.')" class="btn btn-icon btn-outline-primary text-primary me-2"><i class="bx bx-edit-alt"></i></a><a href="javascript:delete_msg('.$msg->id.')" class="btn btn-icon btn-outline-danger text-danger"><i class="bx bx-trash-alt"></i></a></div>';
                }elseif ($msg->is_active == true) {
                    $status = '<a href="javascript:changeStatus('.$msg->id.')"><span class="badge bg-label-success">Active</span></a>';
                    $action = '<div class="d-flex"><a href="javascript:edit_msg('.$msg->id.')" class="btn btn-icon btn-outline-primary text-primary me-2"><i class="bx bx-edit-alt"></i></a><a href="javascript:delete_msg('.$msg->id.')" class="btn btn-icon btn-outline-danger text-danger me-2"><i class="bx bx-trash-alt"></i></a><a href="' . url('child-msg/' . $application_id . '/' . $msg->id) . '" class="btn btn-icon btn-outline-dark me-2"><i class="bx bx-plus"></i></a></div>';
                }else{
                    $status = '<a href="javascript:changeStatus('.$msg->id.')"><span class="badge bg-label-danger">Inactive</span></a>';
                    $action = '<div class="d-flex"><a href="javascript:edit_msg('.$msg->id.')" class="btn btn-icon btn-outline-primary text-primary me-2"><i class="bx bx-edit-alt"></i></a><a href="javascript:delete_msg('.$msg->id.')" class="btn btn-icon btn-outline-danger text-danger me-2"><i class="bx bx-trash-alt"></i></a><a href="' . url('child-msg/' . $application_id . '/' . $msg->id) . '" class="btn btn-icon btn-outline-dark"><i class="bx bx-plus"></i></a><div>';
                }
                $send_time = Carbon::createFromFormat('H:i:s', $msg->send_time)->format('h:i A');
                $data[] = [
                    'sr_no' => $i++,
                    'title' => $msg->title,
                    'description' => $msg->message,
                    'daily_time' => $send_time,
                    'status' => $status,
                    'action' => $action
                ];
            }
            return Datatables::of($data)->rawColumns(['action','status'])->make(true);
        }
    }
    public function store($application_id, Request $request)
    {
        if(isset($request->message_id)){
            $msg = AllMessage::find($request->message_id);
            $msg->update([
                'title' => $request->title,
                'message' => $request->message,
                'send_time' => $request->time
            ]);
            if(isset($request->time)){
                $child_apps = AllMessage::where('perent_id',$request->message_id)->get();
                foreach ($child_apps as $child_app) {
                    $app = AllMessage::find($child_app->id);
                    $app->update(['send_time' => $request->time]);
                }
            }
            $res = ['success' => 'Message Update Successfully.'];
            return response()->json($res, 200);
        }
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
        $_msg = AllMessage::find($perentmsg_id);
        $msg = ['msg_title' => $_msg->title,
                'msg' => $_msg->message
            ];
        return view('all_message.child_msg', compact('application_id', 'perentmsg_id','msg'));
    }
    public function child_msg_list($application_id, $perentmsg_id,Request $request)
    {
        if ($request->ajax()) {
            $data = [];$i = 1;
            $_msg = AllMessage::find($perentmsg_id);
            $data[] = [
                'sr_no' => $i++,
                'title' => '<b>'.$_msg->title.'</b>',
                'description' => '<b>'.$_msg->message.'</b>',
                'action' => '<a href="javascript:edit('.$_msg->id.')" class="btn btn-icon btn-outline-primary me-2"><i class="bx bx-edit-alt"></i></a><a href="javascript:deleteChild('.$_msg->id.')" class="btn btn-icon btn-outline-danger me-2"><i class="bx bx-trash-alt"></i></a>'
            ];
            $all_msgs = AllMessage::where('application_id', $application_id)
            ->where('perent_id',$perentmsg_id)
            ->get();
            foreach ($all_msgs as $msg) {
                $data[] = [
                    'sr_no' => $i++,
                    'title' => $msg->title,
                    'description' => $msg->message,
                    'action' => '<a href="javascript:edit('.$msg->id.')" class="btn btn-icon btn-outline-primary me-2"><i class="bx bx-edit-alt"></i></a><a href="javascript:deleteChild('.$msg->id.')" class="btn btn-icon btn-outline-danger me-2"><i class="bx bx-trash-alt"></i></a>'
                ];
            }
            return Datatables::of($data)->rawColumns(['title','description','action'])->make(true);
        }
    }
    public function send_instant_notification(Request $request,$application_id)
    {
        if(isset($request->is_instant)){
            $currentDateTime = Carbon::now();
            $updatedDateTime = $currentDateTime->addMinute(1);
            $updatedTime = $updatedDateTime->format('H:i');
            $msg = AllMessage::create([
                'application_id' => $application_id,
                'title' => $request->title,
                'message' => $request->message,
                'send_time' => $updatedTime,
                'is_instant' => true,
            ]);
            return redirect()->back()->with('message',"Message will sent after minute Successfully ");

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
            return redirect()->back()->with('message',"Message sent Successfully ");
        }
        $msg = Message::create([
            'title' => $request->title,
            'message' => $request->message,
            'send_time' => $request->time,
        ]);
        return redirect('/message')->with('message',"Message Added Successfully ");
    }
    public function edit($application_id)
    {
        $_msg = AllMessage::find($application_id);
        $msg = ['id'=> $_msg->id,'title' => $_msg->title,'message' => $_msg->message,'send_time' => $_msg->send_time];
        return response()->json($msg, 200);
    }
    public function destroy($application_id)
    {
        $child_msgs = AllMessage::where('perent_id',$application_id)->get();
        if(!empty($child_msgs)){
            foreach ($child_msgs as $msg) {
                $msg->delete();
            }
        }
        $_msg = AllMessage::find($application_id);
        $_msg->delete();
        return response()->json(['success' => 'Message Delete Successfully.'], 200);
    }
}
