let filePost = null
$(document).on('click','#open_popup_send_email',function(){
    $('#getPassword').modal('show');
})
$(document).on('click','#send_email_cancel',function(){
    $('#getPassword').modal('hide');
})
$(document).on('click','#login_submit',function(e){
    e.preventDefault();
    let data = {}
    data.email = $('input#email').val();
    data.password = $('input#password').val();
    // Validate email format
    if (!isValidEmail(data.email)) {
        alert('Invalid email format');
        return;
    }

    // Validate password
    if (password.length < 2) {
        alert('Password must be at least 6 characters long');
        return;
    }
    $.ajax({
        type: "POST",
        url: "/account/checkLoginClient",
        data: data,          
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        cache: false,
        success: function (data) {
            if (data.data == 1) {
                $('#login_submit img').css('display','none');
                setTimeout(function(){
                    window.location.href= "/";
                  },400); 
            } else {
                alert('Sever Đã có Lỗi !!!');
            }
        }
    })
})
// Function to validate email format
function isValidEmail(email) {
    // Use a regular expression to validate email format
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}
function parseWordDocxFile(inputElement) {
    let files = inputElement.files || [];
    if (!files.length) return;
    var file = files[0];
    filePost = file;
    var fileExtension = ['application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
    if ($.inArray(file.type, fileExtension) == -1) {
        alert("Only formats are allowed : "+fileExtension.join(', '));
        return
    }
    console.time();
    let reader = new FileReader();
    reader.onloadend = function(event) {
      let arrayBuffer = reader.result;

      mammoth.convertToHtml({arrayBuffer: arrayBuffer}).then(function (resultObject) {
        let result1=document.querySelector('#result1')
        result1.innerHTML = resultObject.value
        console.log(resultObject.value)
      })
      console.timeEnd();
    };
    reader.readAsArrayBuffer(file);
}
function postFile() {
    if (filePost) {
        var fd = new FormData();    
        fd.append('file', filePost);
        $.ajax({
            type: "POST",
            url: "/account/upload",
            processData: false,
            contentType: false,
            cache: false,
            enctype: 'multipart/form-data',
            data: fd,          
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                console.log(data)
            }
        })
    }
}

$(document).on('click','.text-signup',function(e){
    setTimeout(function(){
        window.location.href= "/loginClient";
      },400); 
})