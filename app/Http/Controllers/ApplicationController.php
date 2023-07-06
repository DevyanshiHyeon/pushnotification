<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use DataTables;
use App\Models\AllToken;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class ApplicationController extends Controller
{
    public function index()
    {
        return view('application.index');
    }
    public function application_list()
    {
        $applications = Application::all(['id','name','package_name','api','server_key']);
        $data = [];$i = 1;
        foreach ($applications as $application) {
            $data[] = [
                'sr_no' => $i++,
                'name' => $application->name,
                'package_name' => $application->package_name,
                'action' => '<a href="'.url('application/'.$application->id.'/edit').'" class="btn btn-icon btn-outline-primary me-2"><i class="bx bx-edit-alt"></i></a><a href="'.url('application-info/'.$application->id).'" class="btn btn-icon btn-outline-primary"><i class="bx bx-info-circle"></i></a>'
            ];
        }
        return Datatables::of($data)->rawColumns(['action'])->make(true);
    }
    public function create()
    {
        return view('application.create');
    }
    public function store(Request $request)
    {
        if(isset($request->app_id)){
            $validatedData = $request->validate([
                'name' => ['required','max:255'],
                'package_name' => ['required','regex:/^[a-z]+\.[a-z]+(\.[a-z]+)*$/', Rule::unique('applications', 'package_name')->ignore($request->app_id),],
            ]);
            $app = Application::find($request->app_id);
            $app->update($request->all());
            // make API
            $api = url('/api/add-token/'.$request->app_id.'/'.$request->package_name);
            $app->update(['api'=>$api]);
            return redirect('/application')->with('success','Application Update Successfully.');
        }else{
            $validatedData = $request->validate([
                'name' => ['required','max:255'],
                'package_name' => ['required','regex:/^[a-z]+\.[a-z]+(\.[a-z]+)*$/','unique:applications,package_name'],
            ]);
            $application = Application::create($request->all());
            $application = Application::find($application->id);
            // make API
            $api = url('/api/add-token/'.$application->id.'/'.$request->package_name);
            $application->update(['api'=>$api]);
            return redirect('/application')->with('success','Application Create Successfully.');
        }

    }
    public function edit($application_id)
    {
        $application = Application::find($application_id);
        return view('application.create',compact('application'));
    }
    public function add_token($application_id,$package_name,Request $request)
    {
        $device_info = AllToken::where('application_id','=',$application_id)->where('token', '=', $request->token)->first();
        $current_date = $currentTime = Carbon::now()->toDateString();
        if ($device_info === null) {
            AllToken::create([
                'application_id' => $application_id,
                'token' => $request->token,
                'is_used' => 1,
            ]);
            return response()->json(['Success' => 'Device Token Enter Successfully']);
        } else {
            $device_info->update([
                'is_used' => $device_info->is_used + 1,
            ]);
            return response()->json(['Success' => 'Device Token Count Increse Successfully']);
        }
    }
    public function show($application_id)
    {
        return view('about_application.index');
    }
    public function info($application_id)
    {
        return view('about_application.info');
    }
}
