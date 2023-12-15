$(document).on('click','.icon-table-delete',function(){
    let id = $(this).attr('data-id');
    let title = $(this).attr('data-title');
    if (id) {
        swal({
            title: "Cảnh Báo",
            text: "Bạn có chắc muốn xoá Product " + title + " này không ??",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Cancel",
                ok: "OK"
            },
        }).then(function (isConfirm) {
            if (!isConfirm) return;
            $.ajax({
                url: '/admin/product/delete/' + id,
                type: "DELETE",
            }).done(function (data) {
                if (data.data == 1) {
                    swal("Danh Mục", "Xoá Danh Muc Thành Công", "success");
                    setTimeout(function(){
                        window.location.href= "/admin/product";
                    },200);
                } else {
                    swal("Danh Mục", "Đã có lỗi sảy ra !!", "error");
                }

            });
        });
    }
})