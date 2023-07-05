baseUrl = window.origin;
url = window.location.href;
application_id = $('#application_id').val();
table = $('#myTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: baseUrl+'/feedback-list/'+application_id,
    columns: [
        { data: 'sr_no', name: 'sr_no'},
        { data: 'title', name: 'title' },
        { data: 'description', name: 'description' },
    ],
});
