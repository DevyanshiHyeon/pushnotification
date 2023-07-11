baseUrl = window.origin;
url = window.location.href;
application_id = $("#application_id").val();
perentmsg_id = $("#perentmsg_id").val();
table = $("#myTable").DataTable({
    processing: true,
    serverSide: true,
    ajax: baseUrl + "/child-msg-list/" + application_id + "/" + perentmsg_id,
    columns: [
        { data: "sr_no", name: "sr_no" },
        { data: "title", name: "title" },
        { data: "description", name: "description" },
        { data: "action", name: "action" },
    ],
    columnDefs: [
        {
            targets: 3,
            render: function (data, type, full, meta) {
                return data;
            },
        },
    ],
});

function edit(msg_id) {
    $.ajax({
        url: baseUrl + "/child-message/" + msg_id + "/edit/",
        success: function (res) {
            $("#title").val(res.title);
            $("#message").val(res.message);
            $("#message_id").val(msg_id);
            $("#edit_form").attr(
                "action",
                baseUrl + "/child-message/" + msg_id + "/update"
            );
            $("#editmodal").modal("show");
        },
        error: function (erro) {
            console.log(erro);
        },
    });
}
$("#form_submit").on("click", function (e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: $("#edit_form").attr('action'),
        data: $("#edit_form").serialize(),
        success: function (responce) {
            $("#editmodal").modal("hide");
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
        },
    });
});

function deleteChild(msg_id) {
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
