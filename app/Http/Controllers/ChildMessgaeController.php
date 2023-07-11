<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use DataTables;
use App\Models\AllMessage;

class ChildMessgaeController extends Controller
{
    public function index($id,Request $request)
    {
        if ($request->ajax()) {
            $msges = Message::select('id','title','message')->where('perent_id','=',$id)->orderBy('id', 'DESC')->get();

            $data = [];$i=1;
            foreach($msges as $msg){
                $action = '<a href="'.url('/edit-child-message/'.$msg->id).'" class="btn btn-primary">Edit</a>';
                $data[] = [
                    'sr_no' => $i++,
                    'title' => $msg->title,
                    'msg' => $msg->message,
                    'action' => $action,

                ];
            }
            return Datatables::of($data)->rawColumns(['status','action'])->make(true);
        }
        return view('child_msg.index')->with(['id'=>$id]);
    }
    public function store(Request $request)
    {
        if(isset($request->msg_id) && isset($request->parent_id)){
            $msg = Message::find($request->msg_id);
            $msg->update([
                'title' => $request->title,
                'message' => $request->message,
            ]);
            return redirect('child-message/'.$request->parent_id)->with('message',"Message Updated Successfully ");
        }
        if(isset($request->parent_id)){
            $perent_msg =  Message::find($request->parent_id);
            $msg = Message::create([
                'title' => $request->title,
                'message' => $request->message,
                'send_time' => $perent_msg->send_time,
                'perent_id' => $request->parent_id,
            ]);
            return redirect()->back()->with('message',"Message Added Successfully ");
        }

        return 'some thing went wrong';
    }
    public function edit(Request $request,$id)
    {
        $msg = Message::find($id);
        return view('child_msg.index',['msg'=>$msg]);
    }
    public function editChild($message_id)
    {
        $app = AllMessage::find($message_id);
        return response()->json($app, 200);
    }
    public function updateChild(Request $request,$message_id)
    {
        $app = AllMessage::find($message_id);
        $app->update([
            'title' => $request->title,
            'message' => $request->message
        ]);
        return response()->json(['success' => 'Message Updated Successfully.'], 200);
    }
}
