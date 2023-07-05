baseUrl = window.origin;
url = window.location.href;
table = $('.datatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: url,
    columns: [
        { data: 'sr_no', name: 'sr_no' },
        { data: 'title', name: 'title' },
        { data: 'msg', name: 'msg' },
        { data: 'action', name: 'action' }
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


