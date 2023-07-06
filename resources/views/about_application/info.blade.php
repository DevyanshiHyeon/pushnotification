@extends('layout.app')
@section('style')
    <style>
        .code-container {
            background-color: #f5f5f5;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-family: 'Courier New', Courier, monospace;
        }

        .code-block {
            white-space: pre;
            padding-left: 20px;
            /* Adjust the value as needed */
        }
    </style>
@endsection
@section('contant')
    @include('about_application.navbar')
    @php
        use Illuminate\Support\Facades\Request;
        $application_id = Request::route('application_id');
    @endphp
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <h5 class="card-header">Instruction for Add device Tokens</h5>
                <div class="card-body">
                    <ul>
                        <li>Launch the Postman application on your computer.</li>
                        <li>Choose the HTTP request method POST </li>
                        <li>In the URL input field, enter the full URL</li>
                        <div class="code-container">
                            <pre class="code-block" id="url_1">
                    </pre>
                        </div>
                        <li>Click on the "Headers" tab below the URL input field.</li>
                        <li>Add the required headers, such as Content-Type if you are sending JSON data.</li>
                        <li> Click on the "Body" tab below the URL input field.</br>
                            Select the "raw" option.</br>
                            Choose "JSON" from the dropdown next to the "raw" option.</li>
                        <li>
                            Enter your JSON data in the text area below.</br>Make sure the JSON is properly
                            formatted</br>
                            <img src="{{ url('images/screen_shorts/token-add.png') }}" alt="">
                        </li>
                        <li>Click on the "Send" button to send the API request with the provided JSON data.</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <h5 class="card-header">Instruction for Add Feedbacks</h5>
                <div class="card-body">
                    <ul>
                        <li>Launch the Postman application on your computer.</li>
                        <li>Choose the HTTP request method POST </li>
                        <li>In the URL input field, enter the full URL</li>
                        <div class="code-container">
                            <pre class="code-block" id="url_2">
                    </pre>
                        </div>
                        <li>Click on the "Headers" tab below the URL input field.</li>
                        <li>Add the required headers, such as Content-Type if you are sending JSON data.</li>
                        <li> Click on the "Body" tab below the URL input field.</br>
                            Select the "raw" option.</br>
                            Choose "JSON" from the dropdown next to the "raw" option.</li>
                        <li>
                            Enter your JSON data in the text area below.</br>Make sure the JSON is properly
                            formatted</br>
                            <img src="{{ url('images/screen_shorts/feedbackadd.png') }}"
                                style="max-width: 100%;
                    max-height: 100%;
                    display: block;"
                                alt="">
                        </li>
                        <li>Click on the "Send" button to send the API request with the provided JSON data.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ url('js/custom/about_application/info.js') }}"></script>
@endsection
