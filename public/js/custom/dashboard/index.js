baseUrl = window.origin;
table = $('#datatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: baseUrl + '/get-data',
    columns: [
        { data: 'sr_no', name: 'sr_no' },
        { data: 'date', name: 'date' },
        { data: 'new_use', name: 'new_use' },
        { data: 'repeated_users', name: 'repeated_users' },
        { data: 'success_count', name: 'success_count' },
    ],
    columnDefs: [{
        targets: 4,
                    render: function (data, type, full, meta) {
            return data;
        },
    }]
});
