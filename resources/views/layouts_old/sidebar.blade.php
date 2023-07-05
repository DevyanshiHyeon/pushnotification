<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#">Notification</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"> </span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
        <div class="me-4" data-toggle="modal" data-target="#apiInstruction"><i class="mdi mdi-information-outline fs-3 text-warning"></i></div>
        <ul class="navbar-nav mr-auto sidenav" id="navAccordion">
            <li class="nav-item">
                <a class="nav-link nav-link-collapse" href="#" id="hasSubItems" data-toggle="collapse"
                    data-target="#collapseSubItems2" aria-controls="collapseSubItems2" aria-expanded="false"> Screen Casting
                </a>
                <ul class="nav-second-level collapse" id="collapseSubItems2" data-parent="#navAccordion">
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/message-dashboard')}}">
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/message')}}">
                            <span class="nav-link-text">Message</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="javascropt:void(0)"></a>
            </li>
        </ul>
    </div>
</nav>
<!-- Modal -->
<div class="modal fade" id="apiInstruction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">API Instruction</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="entry-content">
                <ul>
                   <li>Open Postman: Launch the Postman application on your computer.</li>
                   <li>Create a New Request: Click on the "New" button to create a new request.</li>
                   <li>Set Request Method and URL: In the request configuration panel, select "POST" as the request method. Enter the URL of the API endpoint you want to test in the URL field.</li>
                   <li>Set Request Headers: Click on the "Headers" tab below the URL field. Add a new header with the key "Content-Type" and set the value to "application/json". This indicates that the request body will be in JSON format.</li>
                   <li>Set Request Body: Click on the "Body" tab below the URL field. Select the "raw" option, and from the dropdown next to it, select "JSON (application/json)". This allows you to enter the JSON data in the request body.</li>
                   <li>Enter JSON Data: In the request body field, enter the JSON data you want to send in the request. Make sure it follows the correct JSON format.</li>
                   <li>For example:</li>
                   <img src="https://pushnotification.appomania.co.in/public/images/screen_shorts/Annotation%202023-05-11%20124633.png" alt="">
                   <li>Send the Request: Click on the "Send" button to send the POST request with the JSON data.</li>
                   <li>View Response: Postman will display the response received from the API endpoint in the response panel below the request configuration.</li>
                 </ul>
               </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>