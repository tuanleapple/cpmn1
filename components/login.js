let count = 0;
$(document).on('click','.btn-login',function(){
    let data ={};
    data.user = $('#user_login').val();
    data.password = $('#password_login').val();
    src = $(this).attr('data-src');
    if(data.user.length == 0 || data.password.length ==0){
      swal("Thông Báo", "Vui Lòng Điền Đầy Đủ Thông Tin !!", "error");
      return false;
    }
    if(count == 3 ){
      $.ajax({
        type:'post',
        url:'/blockapis',
        cache: false,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function (data) {
          if (data.data == 1) {
            swal("LOGIN", "Bạn đã hết số lần đăng nhập vui lòng liên hệ quản trị viên mở lại !!!", "error");
            return;
          }
        },
      })
    }
    $.ajax({
        type:'post',
        url:'/login/check',
        data:data,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function (data) {
          if (data.data == 1) {
            swal("Login", "Thêm Login Thành Công", "success");
            if(src){
              setTimeout(function(){
                console.log(src)
                window.location.href=src;
              },400); 
            }else{
              setTimeout(function(){
                window.location.href= "/admin/collection";
              },400); 
            }}
            else if(data.data == 0) {
              swal("Login", "account no access in admin", "error");
             
            }else{
              swal("Login", "user or password wrong", "error");
             
              count++;
              if(count >= 2){
                $('.time-reset').removeClass('d-none');
                $('.time-login').html('');
                $('.time-login').html(6-count);
              }
            }
        },
        error:function(){
            swal("Login", "Đã có lỗi sảy ra !!", "error");
        }
      })
})

 $(document).on('keypress','#user_login',function(e){
    if(e.keyCode == 13){
      $('.btn-login').click();
      return false;
    }
 })
 $(document).on('keypress','#password_login',function(e){
  if(e.keyCode == 13){
    $('.btn-login').click();
    return false;
  }
})

$(document).on('click','.text-signup',function(e){
  if(e.keyCode == 13){
    $('.btn-login').click();
    return false;
  }
})