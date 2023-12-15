$(document).ready(function () {
    $('.selectCollection').select2({
        width: '100%'
    });
})

$(document).on('click', '#createCollection', async function () {
    $('#titleCollection').val('');
    $('#desCollection').val('');
    $('select[name="selectCollection"]').val(-1);
    await collection();
    $('#collectionModal').modal('show');
})

function collection() {
    $.ajax({
        type: "POST",
        url: "/admin/collection/getCollection",
        cache: false,
        success: function (data) {
            $('select[name="selectCollection"]').find('option').not(':first').remove();
            $.each(data.collection, function (index, value) {
                $('select[name="selectCollection"]').append('<option value="' + value.id + '">' + value.title + '</option>')
            })
        }
    })
}
$(document).on('click', '#saveModalCollection', function () {
    var data = {};
    data.id = $(this).attr('data-checkid')
    data.title = $('#titleCollection').val().trim();
    data.des = $('#desCollection').val()
    data.parent_id = $('select[name="selectCollection"]').val();
    if (data.parent_id == -1) {
        data.parent_id = 0;
    }
    if (data.title.length == 0) {
        return swal({
            title: "Cảnh Báo!",
            text: "Vui Lòng Nhập Tiêu Đề!",
            icon: "error",
            buttons: false,
        });
    }
    if (data.id == null || data.id == undefined) {
        $.ajax({

            type: "POST",
            url: "/admin/collection/createCollection",
            data: data,
            cache: false,
            success: function (data) {
                if (data.data == 1) {
                    $('#collectionModal').modal('hide');
                    swal("Danh Mục", "Thêm Danh Muc Thành Công", "success");
                    setTimeout(function(){
                        window.location.href= "/admin/collection";
                      },400); 
                } else {
                    swal("Danh Mục", "Đã có lỗi sảy ra !!", "error");
                }
            }
        })
    } else {
        $.ajax({
            type: "POST",
            url: "/admin/collection/editCollection",
            data: data,
            cache: false,
            success: function (data) {
                if (data.data == 1) {
                    $('#collectionModal').modal('hide');
                    swal("Danh Mục", "Chỉnh sửa Danh Muc Thành Công", "success");
                    setTimeout(function(){
                        window.location.href= "/admin/collection";
                      },400); 
                } else {
                    swal("Danh Mục", "Đã có lỗi sảy ra !!", "error");
                }
            }
        })
    }

})
$(document).on('click', '#closeModalCollection', function () {
    $('#collectionModal').modal('hide');
})

$(document).on('click', '.icon-table-edit', async function () {
    let id = await $(this).attr('data-id'),
        title = $(this).attr('data-title'),
        des = $(this).attr('data-des'),
        parent = await $(this).attr('data-parent');
    if (des === 'null') {
        des = '';
    }
    $('#titleCollection').val(title);
    $('#desCollection').val(des);
    await getParentCollection(id, parent);
    $('#saveModalCollection').attr('data-checkid', id)
    $('#collectionModal').modal('show');
})
$(document).on('click', '.icon-table-delete', function () {
    let id = $(this).attr('data-id');
    let title = $(this).attr('data-title');
    if (id) {
        swal({
            title: "Cảnh Báo",
            text: "Bạn có chắc muốn xoá collection " + title + " này không ??",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Cancel",
                ok: "OK"
            },
        }).then(function (isConfirm) {
            if (!isConfirm) return;
            $.ajax({
                url: '/admin/collection/delete/' + id,
                type: "DELETE",
            }).done(function (data) {
                if (data.data == 1) {
                    $('#collectionModal').modal('hide');
                    swal("Danh Mục", "Xoá Danh Muc Thành Công", "success");
                    setTimeout(function(){
                        window.location.href= "/admin/collection";
                      },400); 

                } else {
                    swal("Danh Mục", "Đã có lỗi sảy ra !!", "error");
                }

            });
        });
    }
})


async function getParentCollection(id, parent) {
    let data = {};
    data.id = await id;
    data.parent = await parent
    $.ajax({
        type: "POST",
        url: "/admin/collection/getParentCollection/" + data.id,
        data: data,
        cache: false,
        success: function (data) {
            console.log(data)
            if (data.status == 1) {
                $('select[name="selectCollection"]').find('option').not(':first').remove();
                $('select[name="selectCollection"]').append(data.data);
            } else {
                swal("Danh Mục", "Đã có lỗi sảy ra !!", "error");
            }

        }
    })
}
