baseUrl = window.origin;
function create_message() {
    $('#form').validate(
        {
            rules: {
                'title': 'required',
                'message': 'required',
                'time': 'required'
            }, messages: {
                'title': 'Title Is Required',
                'message': 'Message is Required',
                'time': 'Time id Required'
            }
        }
    )
    $("#form").submit();
}

table = $('.datatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: baseUrl + '/get-message',
    columns: [
        { data: 'sr_no', name: 'sr_no' },
        { data: 'title', name: 'title' },
        { data: 'msg', name: 'msg' },
        { data: 'send_time', name: 'send_time' },
        { data: 'status', name: 'status' },
        { data: 'action', name: 'action' }
    ],
    columnDefs: [
        {
            targets: 4,
            render: function (data, type, full, meta) {
                return data;
            },
        },
        {
            targets: 5,
                        render: function (data, type, full, meta) {
                return data;
            },
        }
    ]
});
$('#ajax-alert').hide();
function change_status(message_id) {
    $.ajax({
        url: baseUrl + '/change-message-status/' + message_id,
        success: function (responce) {
            console.log(responce);
            table.ajax.reload();
            toastr.options = {
                "closeButton": true,
                "debug": true,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "showDuration": "300",
                "hideDuration": "1000000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr["success"](responce.success, "Success");
        }, error: function (responce) {
            console.log(responce);
        }
    })
}
function deleteMessage(msg_id) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
        customClass: {
            confirmButton: "btn btn-primary me-1",
            cancelButton: "btn btn-label-secondary",
        },
        buttonsStyling: false,
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: baseUrl + "/delete-msg/" + msg_id,
            }).done(function (res) {
                Swal.fire({
                    icon: "success",
                    title: "Deleted!",
                    text: res.success,
                    customClass: {
                        confirmButton: "btn btn-success",
                    },
                });
                table.ajax.reload();
            });

        }
    });
}
