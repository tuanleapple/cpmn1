$(document).ready(function () {
    $('#selectCollection').select2({
        width: '100%'
    });
    
})
$(document).on('click','#createCollectionProduct',function(){
    let data ={};
    data.title = $('input[name="title"]').val();
    data.title_en = $('input[name="title_en"]').val();
    data.parent_id =$('#selectCollection').find(':selected').val() ;
    data.image = $('input[name="image"]').val();
    data.content = $('#content-vi').val();
    data.content_en = $('#content-en').val();
    data.description = $('#description-vi').val();
    data.description_en = $('#description-en').val();
    data.meta_title_vi = $('#meta-title-vi').val();
    data.meta_title_en = $('#meta-title-en').val();
    if(data.title.length ==0){
        return swal({
            title: "Cảnh Báo!",
            text: "Vui Lòng Nhập Tiêu Đề!",
            icon: "error",
            buttons: false,
        });
    }
    $.ajax({
        type:'POST',
        url:'/admin/collectionProduct/create',
        data:data,
        cache: false,
        success: function (data) {
            if (data.data == 1) {
                swal("Danh Mục", "Thêm Danh Mục Thành Công", "success");
                setTimeout(function(){
                  window.location.href= "/admin/collectionProduct";
              }); 
            } else {
                swal("Danh Mục", "Đã có lỗi sảy ra !!", "error");
            }
        }
    })
})
$(document).on('click','#editCollectionProduct',function(){
    let data ={};
    data.id=$(this).attr('data-id');
    data.title = $('input[name="title"]').val();
    data.title_en = $('input[name="title_en"]').val();
    data.parent_id =$('#selectCollection').find(':selected').val() ;
    data.image = $('input[name="image"]').val();
    data.slug = $('input[name="link"]').val();
    data.slug_en = $('input[name="link_en"]').val();
    data.content = $('#content-vi').val();
    data.content_en = $('#content-en').val();
    data.description = $('#description-vi').val();
    data.description_en = $('#description-en').val();
    data.meta_title_vi = $('#meta-title-vi').val();
    data.meta_title_en = $('#meta-title-en').val();
    if(data.title.length ==0){
        return swal({
            title: "Cảnh Báo!",
            text: "Vui Lòng Nhập Tiêu Đề!",
            icon: "error",
            buttons: false,
        });
    }
    $.ajax({
        type:'POST',
        url:'/admin/collectionProduct/edit',
        data:data,
        cache: false,
        success: function (data) {
            if (data.data == 1) {
                swal("Danh Mục", "Chỉnh Danh Mục Thành Công", "success");
                setTimeout(function(){
                  window.location.href= "/admin/collectionProduct";
              }); 
            } else {
                swal("Danh Mục", "Đã có lỗi sảy ra !!", "error");
            }
        }
    })
})
$(document).on('change', 'input[name="post-image"]', function (e) {
    var ext = $(this).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) {
        swal('Lỗi', 'Vui lòng chọn đúng định dạnh ảnh', 'error');
        $(this).val('');
        return;
    }
    var formData = new FormData($('form.form-feature-product')[0]);
    $.ajax({
        type: 'POST',
        url: '/admin/collectionProduct/create/image',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (json) {
            if(json.data == 1){
                $('form.form-feature-product').find('img').attr('src','/upload/collectionProduct/'+json.name);
                $('form.form-feature-product').find('input[name="image"]').val(json.name)
            }else{
                swal("Hình ảnh ", "Đã có lỗi sảy ra !!", "error");
            }
        },
        error: function (data) {}
    });
});
