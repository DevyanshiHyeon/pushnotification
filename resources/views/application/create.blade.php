@extends('layout.app')
@section('contant')
<div class="row mt-4">
    <div class="col-8 grid-margin stretch-card">
        <div class="card mb-4">
            <div class="card-body">
              <h5 class="card-header">Application</h5>
              <form class="forms-sample" id="form" action="{{url('application')}}" method="POST">@csrf
                @if(isset($application->id))
                <input type="hidden" value="{{$application->id}}" name="app_id" />
                @endif
                <div class="form-group">
                    @foreach ($errors->all() as $error)
    {{ $error }}<br/>
@endforeach
                  <label>App Name</label>
                  <input type="text" name="name" class="form-control" id="name" placeholder="App Name" @if(isset($application->name)) value="{{$application->name}}" @endif value="{{ old('name') }}"  >
                  @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                  <label>Package Name</label>
                  <input type="text" class="form-control" id="package_name" name="package_name" placeholder="Package Name" @if(isset($application->package_name)) value="{{$application->package_name}}" @endif value="{{ old('package_name') }}" />
                  @error('package_name')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputConfirmPassword1">Server Key</label>
                  <input type="text" class="form-control" id="server_key" name="server_key" placeholder="Server Key" @if(isset($application->server_key)) value="{{$application->server_key}}" @endif value="{{ old('server_key') }}" />
                  @error('server_key')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <button type="submit" class="btn btn-primary me-2">Submit</button>
                <a href="{{url('/application')}}" class="btn btn-light">Cancel</a>
              </form>
            </div>
          </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{url('js/custom/application/create.js')}}"></script>
@endsection
