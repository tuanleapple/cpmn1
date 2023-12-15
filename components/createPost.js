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
        url: '/admin/post/create/image',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (json) {
            if(json.data == 1){
                $('form.form-feature-product').find('img').attr('src','/upload/post/'+json.name);
                $('form.form-feature-product').find('input[name="image"]').val(json.name)
            }else{
                swal("Hình ảnh ", "Đã có lỗi sảy ra !!", "error");
            }
        },
        error: function (data) {}
    });
});
$(function(){
    $('.selectCollection').select2({
        width: '100%'
    });
    initTinymce('textarea#contentPost',600)
    collection();
})
function collection() {
    $.ajax({
        type: "GET",
        url: "/admin/post/getCollection",
        // cache: false,
        success: function (data) {
            $('select[name="selectCollection"]').find('option').not(':first').remove();
            $.each(data, function (index, value) {
                $('select[name="selectCollection"]').append('<option value="' + value.id + '">' + value.title + '</option>')
            })
        }
    })
}

$(document).on('click','#createPost',function(){
  let data ={};
  data.title = $('input[name="title"]').val();
  data.parent_id = $('select[name="selectCollection"]').val();
  data.tag = $('input[name="hashtag"]').tagsinput('items');
  data.image = $('input[name="image"]').val();
  data.content = tinymce.get("contentPost").getContent();
  $.ajax({
    type:'post',
    url:'/admin/post/createPost',
    data:data,
    success: function (data) {
      if (data.data == 1) {
        swal("Bài Viết", "Thêm Bài Viết Thành Công", "success");
        setTimeout(function(){
          window.location.href= "/admin/post";
      }, 5000); 
    } else {
        swal("Bài Viết", "Đã có lỗi sảy ra !!", "error");
    }
  }
  })

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
          'emoticons template paste textpattern imagetools autoresize codesample fullpage help '
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent insertdatetime| link image codesample | table visualblocks visualchars tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol',
        toolbar2: 'print preview fullpage fullscreen | code media hr pagebreak | forecolor backcolor emoticons | paste searchreplace | rtl ltr wordcount',
      
        image_advtab: true,
        automatic_uploads: true,
        images_upload_base_path: '/upload',
        imageupload_url: '/',
        file_browser_callback_types: 'file image media',
        file_browser_callback: function(field_name, url, type, win) {
          tinymce.activeEditor.windowManager.open({
              title: "Chọn ảnh",
              filetype: 'all',
              file: '/api/tinymce/image',
              width: 800,
              height: 400,
              inline: 1
            }, {
            window : win,
            input : field_name
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
          xhr.onload = function() {
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