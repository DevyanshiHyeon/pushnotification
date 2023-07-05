baseUrl = window.origin;
url = window.location.href;
application_id = $('#application_id').val();
table = $('#myTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: baseUrl+'/all-message-list/'+application_id,
    columns: [
        { data: 'sr_no', name: 'sr_no'},
        { data: 'title', name: 'title' },
        { data: 'description', name: 'description' },
        { data: 'action', name: 'action'}
    ],
    columnDefs: [
        {
            targets: 3,
            render: function (data, type, full, meta) {
                return data;
            },
        },
    ]
});
