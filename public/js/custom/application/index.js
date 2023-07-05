baseUrl = window.origin;
url = window.location.href;
table = $('#myTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: baseUrl+'/application-list',
    columns: [
        { data: 'sr_no', name: 'sr_no'},
        { data: 'name', name: 'name' },
        { data: 'package_name', name: 'package_name' },
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
