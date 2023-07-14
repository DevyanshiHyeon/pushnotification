baseUrl = window.origin;
url = window.location.href;
application_id = $("#application_id").val();
table = $("#myTable").DataTable({
    processing: true,
    serverSide: true,
    ajax: baseUrl + "/all-message-list/" + application_id,
    columns: [
        { data: "sr_no", name: "sr_no" },
        { data: "title", name: "title" },
        { data: "description", name: "description" },
        { data: "daily_time", name: "daily_time" },
        { data: "status", name: "status" },
        { data: "action", name: "action" },
    ],
    columnDefs: [
        {
            targets: 4,
            render: function (data, type, full, meta) {
                return data;
            },
        },
        {
            targets: 3,
            render: function (data, type, full, meta) {
                return data;
            },
        },
    ],
});
function edit_msg(msg_id) {
    $.ajax({
        url: baseUrl + "/message/edit/" + msg_id,
        success: function (res) {
            $("#editmodal").modal("show");
            $("#title").val(res.title);
            $("#message").val(res.message);
            $("#message_id").val(msg_id);
            $('#send_time').val(res.send_time);
            // $("#edit_form").attr("action", "");
            // console.log(res);
        },
        error: function (err) {},
    });
}
$("#form_submit").on("click", function () {
    $.ajax({
        type: $("#edit_form").attr("method"),
        url: $("#edit_form").attr("action"),
        data: $("#edit_form").serialize(),
        success: function (res) {
            $("#myElem").text(res.success);
            $("#myElem").show();
            table.ajax.reload();
            setTimeout(function () {
                $("#myElem").hide();
            }, 5000);
            $("#editmodal").modal("hide");
        },
        error: function (err) {
            console.log(err);
        },
    });
});
function delete_msg(msg_id) {
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
                url: baseUrl + "/message/delete/" + msg_id,
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
function changeStatus(application_id){
    $.ajax({
        url: baseUrl + '/application/'+application_id+'/change-status',
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
