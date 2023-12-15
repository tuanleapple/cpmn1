

$(document).on('click','#registers_submit',function(){
    let data = {}
    data.fullname = $('input#fullName').val();
    data.tax = $('input#phoneNumber').val();
    validatePhonenumber(data.tax);
    data.email = $('input#email').val();
    data.password = $('input#password').val();
    data.dob = $('input#dob').val();
    data.password_again = $('input#password_again').val();
    let checkGenderMale = $('input[name="male"]:checked').length;
    let checkGenderFeMale = $('input[name="fe_male"]:checked').length;
    if(checkGenderMale == 1){
        data.gender = 0;
    }if(checkGenderFeMale == 1){
        data.gender = 1;
    }
    if(checkGenderFeMale == 0 && checkGenderMale == 0){
        data.gender = -1;
    }
    checkPassword();
    $.ajax({
        type: "POST",
        url: "/account/create",
        data: data,          
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        cache: false,
        success: function (data) {
            if (data.status == 1) {
                setTimeout(function(){
                    window.location.href= "/account/view";
                  },400); 
            } else {
                alert('Sever Đã có Lỗi !!!');
            }
        }
    })
    
})
function checkPassword(){
    if ($('#password').val() == $('#password_again').val()) {
        $('.message').css('display', 'none');
    }
    if ($('#password').val() != $('#password_again').val()) {
        $('.message').css('display', 'none');
        return;
    }
    if ($('#password').val() <=7 || $('#password_again').val() <=7) {
        $('.password_error').css('display', 'block');
        return;
    }else{
        $('.password_error').css('display', 'none');
    }
}
$('#password, #password_again').on('keyup', function () {
    if ($('#password').val() == $('#password_again').val()) {
        $('.message').css('display', 'none');
    }else{
        $('.message').css('display', 'block');
    }
});
$('#setC input').click(function() {
	$('#setC input').not(this).prop('checked', false);
});
function validatePhonenumber(phonenumber) {
    var phoneno = /^(0|[\+]84)([1389]{1})([0-9]{8}|[0-9]{9})$/;
    return phoneno.test(phonenumber);
}

