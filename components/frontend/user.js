$('#setC input').click(function() {
	$('#setC input').not(this).prop('checked', false);
});
$(document).on('change', 'input[name="avatar"]', function (e) {
    var ext = $(this).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) {
        swal('Lỗi', 'Vui lòng chọn đúng định dạnh ảnh', 'error');
        $(this).val('');
        return;
    }
    var formData = new FormData($('form.form-feature-product')[0]);
    $.ajax({
        type: 'POST',
        url: '/avatar',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (json) {
            if(json.data == 1){
                let imageUrl = '/images/'+json.name+'';
                $('#imgTest').css('background-image','url(' + imageUrl + ')')
                $('#logo_user').css('background-image','url(' + imageUrl + ')')
            }else{
                alert( "Đã có lỗi sảy ra !!");
            }
        },
        error: function (data) {}
    });
});