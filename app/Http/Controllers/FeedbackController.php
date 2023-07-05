<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use DataTables;
use Illuminate\Support\Facades\Log;

class FeedbackController extends Controller
{
    public function index($application_id)
    {
        return view('about_application.feedback');
    }
    public function feedback_list($application_id,Request $request)
    {
        if ($request->ajax()) {
            $feedbacks = Feedback::where('application_id',$application_id)->get();
        $data = [];$i = 1;
        foreach ($feedbacks as $feedback) {
            $data[] = [
                'sr_no' => $i++,
                'title' => $feedback->title,
                'description' => $feedback->description,

            ];
        }
        return Datatables::of($data)->make(true);
        }
    }
    public function store($application_id,Request $request)
    {
        try{
            $fed = Feedback::create([
            'application_id'=> $application_id,
            'title' => $request->title,
            'description' => $request->description
        ]);
        return 'feedback Added Successfully.';
        }catch(\Exception $e){
            return ($e->getMessage());
        }
    }
}
