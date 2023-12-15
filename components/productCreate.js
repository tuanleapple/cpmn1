$(document).ready(function () {
    $('#selectCollection').select2({
        width: '100%'
    });
    $('#selectGender').select2({
        width: '100%'
    });
    // $('#selectSize').select2({
    //     width: '100%'
    // });
    initTinymce('textarea#description', 600)
})
function initTinymce(selector, height) {
    if ($(selector).length) {
        tinymce.init({
            selector: selector,
            height: height,
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking table directionality',
                'emoticons template paste textpattern imagetools autoresize codesample help '
            ],
            toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent insertdatetime| link image codesample | table visualblocks visualchars tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol',
            toolbar2: 'print preview fullscreen | code media hr pagebreak | forecolor backcolor emoticons | paste searchreplace | rtl ltr wordcount',

            image_advtab: true,
            automatic_uploads: true,
            images_upload_base_path: '/upload',
            imageupload_url: '/',
            file_browser_callback_types: 'file image media',
            file_browser_callback: function (field_name, url, type, win) {
                tinymce.activeEditor.windowManager.open({
                    title: "Chọn ảnh",
                    filetype: 'all',
                    file: '/api/tinymce/image',
                    width: 800,
                    height: 400,
                    inline: 1
                }, {
                    window: win,
                    input: field_name
                });
            },
            images_upload_handler: function (blobInfo, success, failure) {
                var xhr, formData;
                // var csrfToken = tryout.getResponseHeader('x-csrf-token');
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '/api/tinymce/uploadImage');
                xhr.setRequestHeader('x-csrf-token', csrfToken);
                xhr.onload = function () {
                    var json;
                    if (xhr.status != 200) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }
                    json = JSON.parse(xhr.responseText);

                    if (!json || typeof json.location != 'string') {
                        failure('Invalid JSON: ' + xhr.responseText);
                        return;
                    }
                    success(json.location);
                };
                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                xhr.send(formData);
            }
        });
    }
}
$(document).on('change', 'input[type="file"]', function (e) {
    var ext = $(this).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) {
        swal('Lỗi', 'Vui lòng chọn đúng định dạnh ảnh', 'error');
        $(this).val('');
        return;
    }

    let len_img = $('input[type="file"]')[0].files.length
    if (len_img >= 6) {
        swal('Lỗi', 'Vui lòng chọn ảnh không vượt quá 5', 'error');
        return;
    }
    var formData = new FormData;
    $.each($('input[type="file"]')[0].files, function (i, value) {
        formData.append('file[' + i + ']', value); // change this to value
    });
    $.ajax({
        type: 'POST',
        url: '/admin/product/create/image',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.data == 1) {
                $.each(data.images, function (index, value) {
                    $('.image_upload').append('<div class="item" data-getImage="' + value + '"><a class="image_a_upload"><img src="/upload/product/' + value + '" style="padding: 0.25rem;"/></a><i class="fas fa-times item-icon" data-image="' + value + '"></i></div>')
                })
            }
        },
    });
});
$(document).on('click', '.item-icon', function () {
    let data = {};
    data.image = $(this).attr('data-image');
    let delete_iamge = $(this).parent('.item');
    if (data.image.length != 0) {
        $.ajax({
            type: 'POST',
            url: '/admin/product/delete/image',
            data: data,
            cache: false,
            success: function (data) {
                if (data.data == 1) {
                    swal('Delete', 'Delete image success ...', 'success');
                    delete_iamge.remove();
                }
            },
        });
    }
})

$(document).on('click', '#createCollectionProduct', async function () {
    let data = {};
    let images = [];
    let sizes = [];
    let qualitys = [];
    let number = $(".image_upload").children().length;
    let inputSize = $(".atribute-info-css").children().length;
    data.title = $('#title').val();
    if (data.title.length == 0) {
        swal('error', 'please write title', 'error');
        return;
    }
    data.collection = $('#selectCollection').find(':selected').val();
    for (let i = 0; i < number; i++) {
        await images.push($(".image_upload .item").eq(i).attr('data-getimage'));
    }
    for (let j = 0; j < inputSize; j++) {
        await sizes.push($(".atribute-info-css").eq(j).find('.row .input-size-quality').attr('data-size-attribute'));
    }
    for (let f = 0; f < inputSize; f++) {
        await qualitys.push($(".atribute-info-css .row").eq(f).find('input.input-size-quality').val());
    }
    data.size = sizes;
    data.quality = qualitys;
    data.image = images;
    data.first_image = images[0];
    data.description = tinymce.get("description").getContent()
    data.gender = $('#selectGender').find(':selected').val();
    data.display = $('#checkdisplay:checked').length;
    data.highlight = $('#checkhighlight:checked').length;
    data.meta_title = $('.meta-title').val();
    $.ajax({
        type: 'POST',
        url: '/admin/product/createProduct',
        data: data,
        cache: false,
        success: function (data) {
            if (data.data == 1) {
                swal('create Product', 'Create Product', 'success');
                setTimeout(function(){
                    window.location.href= "/admin/product";
                },200); 
            }
        },
    });
})
$(document).on('click', '#plus-size', function () {
    $('#SizeModal').modal('show');
    $('#titleSize').val('');
})
$(document).on('click', '#closeModalSize', function () {
    $('#SizeModal').modal('hide');
    $('#titleSize').val('');
})
$(document).on('change', 'select#selectSize', function () {
    let title = $(this).children('option:selected').attr('data-size');
    let id = $(this).children('option:selected').val();
    if (title) {
        $('.attribute-size').removeClass('d-none');
        $('.attribute-title').append('<span class="attribute-' + title + ' span-attribute">' + title + '</span>')
        let checklength = $('.attribute-title span').length;
        if (checklength == 2) {
            $('.attribute-size-info .attribute-size-info-row').append('<div class="col-sm-2 size">Size </div><div class="col-sm-10 quality-size"> Số Lượng</div>');
            $('.attribute-size-info .attribute-size-info-row').append('<div class="attribute-info-' + title + ' atribute-info-css"><div class="row"><div class="col-sm-2"><label>' + title + '</label></div><div class="col-sm-8"><input class="input-size-quality" placeholder="Vui Lòng nhập số lượng của size tương ứng " data-size-attribute="' + id + '"/></div><div class=" col-sm-2 delete-icon" data-delete-size="' + title + '" data-id="' + id + '"><i class="fas fa-trash-alt"></i></div></div></div>')
        } else if (checklength > 2) {
            $('.attribute-size-info .attribute-size-info-row').append('<div class="attribute-info-' + title + ' atribute-info-css" ><div class="row"><div class="col-sm-2"><label>' + title + '</label></div><div class="col-sm-8"><input class="input-size-quality" placeholder="Vui Lòng nhập số lượng của size tương ứng " data-size-attribute="' + id + '"/></div><div class=" col-sm-2 delete-icon" data-delete-size="' + title + '" data-id="' + id + '"><i class="fas fa-trash-alt"></i></div></div></div>')
        }
        $(this).children('option:selected').attr('disabled','true')
    }
})

$(document).on('click', '.delete-icon', function () {
    let data = $(this).attr('data-delete-size');
    let id = $(this).attr('data-id');
    let variant = $(this).attr('data-variant')
    $('div.attribute-info-' + data + '').remove();
    $('span.attribute-' + data + '').remove();
    let checklength = $('.attribute-title span').length;
    if (checklength == 1) {
        $('.attribute-size').addClass('d-none');
        $('.size,.quality-size').remove();
    }
    $('select#selectSize').children('option:selected').val(id).removeAttr('disabled');
    $('select#selectSize').children('option:selected').val(id).removeAttr('selected');
    if(variant){
        deleteVariant(variant)
    }
})
function deleteVariant(e){
    $.ajax({
        type: 'POST',
        url: '/admin/product/deleteVariant/'+e,
        cache: false,
        success: function (data) {
            if (data.data == 1) {
                swal('delete', 'Delete size và số lượng thành công', 'success');
            }
        },
    });
}
$(document).on('click', '#editCollectionProduct',async function () {
    let data = {};
    let images = [];
    let sizes = [];
    let qualitys = [];
    let number = $(".image_upload").children().length;
    let inputSize = $(".atribute-info-css").children().length;
    data.id = $(this).attr('data-id');
    data.title = $('#title').val();
    data.collection = $('#selectCollection').find(':selected').val();
    for (let i = 0; i < number; i++) {
        images.push($(".image_upload .item").eq(i).attr('data-getimage'));
    }
    for (let j = 0; j < inputSize; j++) {
        await sizes.push($(".atribute-info-css").eq(j).find('.row .input-size-quality').attr('data-size-attribute'));
    }
    for (let f = 0; f < inputSize; f++) {
        await qualitys.push($(".atribute-info-css .row").eq(f).find('input.input-size-quality').val());
    }
    data.size = sizes;
    data.quality = qualitys;
    data.image = images;
    data.first_image = images[0];
    data.description = tinymce.get("description").getContent()
    data.gender = $('#selectGender').find(':selected').val();
    data.display = $('#checkdisplay:checked').length;
    data.highlight = $('#checkhighlight:checked').length;
    data.meta_title = $('.meta-title').val();
    $.ajax({
        type: 'POST',
        url: '/admin/product/edit',
        data: data,
        cache: false,
        success: function (data) {
            if (data.data == 1) {
                swal('Edit Product', 'Edit Product', 'success');
                setTimeout(function () {
                    window.location.href =  "/admin/product";
                }, 200);
            }
        },
    });
})
