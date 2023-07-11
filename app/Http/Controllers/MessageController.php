<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use DataTables;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\returnSelf;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        return view('message.index');
    }
    public function dashboard()
    {
        return view('message.dashboard');
    }
    public function get_message(Request $request)
    {
        if ($request->ajax()) {
            $msges = Message::select('id','title','message','send_time','is_active')->whereNull('perent_id')->orderBy('id', 'DESC')->get();
            $data = [];$i=1;
            foreach($msges as $msg){
                if($msg->is_active == true){
                    $status = '<a href="javascript:change_status('.$msg->id.')"><label class="badge bg-label-success cursor-pointer">Active</label></a>';
                }
                else{
                    $status = '<a href="javascript:change_status('.$msg->id.')"><label class="badge bg-label-danger cursor-pointer">inactive</label></a>';
                }
                $action = '<div class="d-flex gap-2"><a href="'.url('/child-message/'.$msg->id).'" class="btn btn-icon btn-outline-primary"><i class="bx bx-plus"></i></a><a href="'.url('/message-delete/'.$msg->id).'" class="btn btn-icon btn-outline-danger"><i class="bx bx-trash-alt"></i></a></div>';
                $data[] = [
                    'sr_no' => $i++,
                    'title' => $msg->title,
                    'msg' => $msg->message,
                    'send_time' => $msg->send_time,
                    'status' => $status,
                    'action' => $action,

                ];
            }
            return Datatables::of($data)->rawColumns(['status','action'])->make(true);
        }
    }
    public function store(Request $request)
    {
        if(isset($request->is_instant)){
            $msg = Message::create([
                'title' => $request->title,
                'message' => $request->message,
                'send_time' => now()->format('H:i'),
                'is_instant' => true,
            ]);
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
                    DB::table('devices')->where('token', $t)->update(['last_notification_status' => 'sent', 'last_notification_time' => Carbon::now('Asia/Kolkata')]);
                } elseif ($response->getStatusCode() == 200 && $responseData['success'] == 0 && $responseData['failure'] == 1) {
                    // Update the notification status in the database
                    DB::table('devices')->where('token', $t)->update(['last_notification_status' => 'failed', 'last_notification_time' => Carbon::now('Asia/Kolkata')]);
                } else {
                    // Log the error message
                    Log::error('Failed to send notification to ' . $t . ': ' . $response->getBody());
                }
            }
            // return $response->json();
            return redirect('/message')->with('message',"Message Added Successfully ");
        }
        $msg = Message::create([
            'title' => $request->title,
            'message' => $request->message,
            'send_time' => $request->time,
        ]);
        return redirect('/message')->with('message',"Message Added Successfully ");
    }
    public function change_message_status($message_id)
    {
        try{
        $msg = Message::find($message_id);
        if($msg->is_active == 1){
            $msg->update(['is_active'=>0]);
            return response()->json(['success' => 'Status Change SuccessFully']);
        }elseif ($msg->is_active == 0) {
            $msg->update(['is_active'=>1]);
            return response()->json(['success' => 'Status Change SuccessFully']);
        }
    }catch(\Exception $e){
        return $e->getMessage();
    }
    }
    public function destroy($id)
    {
        try{
            $child_msgs = Message::where('perent_id','=',$id)->get();
            foreach($child_msgs as $child_msg){
                $m = Message::find($child_msg->id)->delete();
            }
            $msg = Message::find($id)->delete();
            return redirect('/message')->with('message',"Message Delete Successfully ");
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
}
