$(document).ready(function(){
    $('#selectUser').select2({
        width: '100%'
    });
  $('#selectUserEdit').select2({
                        width: '100%'
                    });
})

$(document).on('click','.openModelUser',function(){
    $('#username').val('')
    $('#password').val('')
    $('#email').val('')
   $('#UserModal').modal('show');
})
$(document).on('click','#closeModalUser',function(){
   $('#UserModal').modal('hide');
})
$(document).on('click','#closeModalUserEdit',function(){
    $('#UserModalEdit').modal('hide');
 })
$(document).on('click','#saveModalUser',function(){
    let data = {};
    data.username = $('#username').val();
    data.password = $('#password').val();
    data.email = $('#email').val();
    data.role = $('#selectUser').find('option:selected').val();
    if(data.username.length == 0 || data.password.length == 0 || data.email.length == 0 || data.role == -2){
        return swal({
            title: "warning!",
            text: "please write full info!",
            icon: "error",
            buttons: false,
        });
    }
    $.ajax({
        type: "POST",
        url: "/admin/createUser",
        data: data,
        cache: false,
        success: function (data) {
            if (data.data == 1) {
                $('#UserModal').modal('hide');
                swal("User", "creaet user success", "success");
                alert($(location).attr('hostname'));
                setTimeout(function(){
                    window.location.reload();
                });

            } else {
                swal("User", "creaet user error!!", "error");
            }
        }
    })
})
$(document).on('click','#saveModalUserEdit',function(){
    let data = {};
    data.id = $(this).attr('data-id');
    data.username = $('#usernameEdit').val();
    data.password = $('#passwordEdit').val();
    data.email = $('#emailEdit').val();
    data.role = $('#selectUserEdit').find('option:selected').val();
    if(data.username.length == 0 || data.password.length == 0 || data.email.length == 0 || data.role == -2){
        return swal({
            title: "warning!",
            text: "please write full info!",
            icon: "error",
            buttons: false,
        });
    }
    $.ajax({
        type: "POST",
        url: "/admin/user/edit",
        data: data,
        cache: false,
        success: function (data) {
            if (data.data == 1) {
                $('#UserModalEdit').modal('hide');
                swal("User", "edit user success", "success");
                setTimeout(function(){
                    window.location.reload();
                });
            } else {
                swal("User", "edit user error!!", "error");
            }
        }
    })
})
$(document).on('click','.editUser',function(){
    id = $(this).attr('data-id');
    if(id){
        $.ajax({
            type: "POST",
            url: "/admin/user/edit/"+id,
            cache: false,
            success: async function(data) {
                if (data.data == 1) {
                     $('#usernameEdit').val(data.user.fullname);
                     $('#emailEdit').val(data.user.email);
                     $('#passwordEdit').val('');
                    await $('#selectUserEdit').val(data.user.role).change();
                     $('#saveModalUserEdit').attr('data-id',data.user.id)
                    $('#UserModalEdit').modal('show');
                } else {
                    swal("User", "edit user error!!", "error");
                }
            }
        })
    }
})
$(document).on('click', '.icon-table-delete', function () {
    let id = $(this).attr('data-id');
    let title = $(this).attr('data-title');
    if (id) {
        swal({
            title: "Cảnh Báo",
            text: "Bạn có chắc muốn xoá danh mục " + title + " này không ??",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: "Cancel",
                ok: "OK"
            },
        }).then(function (isConfirm) {
            if (!isConfirm) return;
            $.ajax({
                url: '/admin/user/delete/' + id,
                type: "DELETE",
            }).done(function (data) {
                if (data.data == 1) {
                    $('#UserModalEdit').modal('hide');
                    swal("User", "Xoá User Thành Công", "success");
                    setTimeout(function(){
                        window.location.reload();
                    });
                } else {
                    swal("User", "edit user error!!", "error");
                }

            });
        });
    }
})