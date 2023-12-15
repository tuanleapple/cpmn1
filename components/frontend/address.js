$(function(){
    getCity();
})
function getCity(){
    $.ajax({
        type: "get",
        url: "/getCity",         
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        cache: false,
        success: function (data) {
            if (data.data == 1) {
                $('#customer_shipping_province').not(':first').remove()
                $('#customer_shipping_district').not(':first').remove()
                $('#customer_shipping_ward').not(':first').remove()
                $.each(data.city, function (index, value) {
                    $('#customer_shipping_province').append('<option value="' + value.id + '">' + value.name + '</option>')
                })
            } else {
                alert('Sever Đã có Lỗi !!!');
            }
        }
    })
}
$(document).on('change','#customer_shipping_province',function(){
    let id = $(this).find('option:selected').val();
    $.ajax({
        type: "get",
        url: "/getDistrict/"+id,         
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        cache: false,
        success: function (data) {
            if (data.data == 1) {
                $('#customer_shipping_district option').not(':first').remove()
                $('#customer_shipping_ward option').not(':first').remove()
                $.each(data.district, function (index, value) {
                    $('#customer_shipping_district').append('<option value="' + value.id + '">' + value.name + '</option>')
                })
            } else {
                alert('Sever Đã có Lỗi !!!');
            }
        }
    })
})
$(document).on('change','#customer_shipping_district',function(){
    let id = $(this).find('option:selected').val();
    $.ajax({
        type: "get",
        url: "/getWard/"+id,         
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        cache: false,
        success: function (data) {
            if (data.data == 1) {
                $('#customer_shipping_ward option').not(':first').remove()
                $.each(data.ward, function (index, value) {
                    $('#customer_shipping_ward').append('<option value="' + value.id + '">' + value.name + '</option>')
                })
            } else {
                alert('Sever Đã có Lỗi !!!');
            }
        }
    })
})
$(document).on('click','#create_new_form_addr',function(){
    $('.addresses .create_form').removeClass('hidden-sm')
    $('.create_addr').addClass('hidden-sm');
})
$(document).on('click','.cancel_update_addr',function(){
    $('.addresses .edit_address').addClass('hidden-sm')
    $('.create_addr').removeClass('hidden-sm');
})
$(document).on('click','.submit_update_addr',function(){
    let data = {};
    data.fname = $('input[name="addr_first_name"]').val();
    data.lname = $('input[name="addr_last_name"]').val();
    data.tax =  $('input[name="addr_phone"]').val();
    data.info =  $('input[name="addr_full_address"]').val();
    data.active = $('input[name="addr_defaule"]:checked').length;
    data.city = $('select[name="customer_shipping_province"]').find('option:selected').val();
    data.district = $('select[name="customer_shipping_district"]').find('option:selected').val();
    data.ward = $('select[name="customer_shipping_ward"]').find('option:selected').val();
    if(data.fname.length == 0 || data.lname.length == 0 || data.tax.length == 0|| data.info.length == 0|| data.city.length == -1|| data.district.length == -1|| data.ward.length == -1){
        alert('Vui lòng Không để thông tin !!!');
        return;
    }
    $.ajax({
        type: "post",
        url: "/addressClient",         
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        cache: false,
        data:data,
        success: function (data) {
            if (data.data == 1) {
                alert('Thêm Thành Công');
                setTimeout(function(){
                    window.location.href= "/account/view=addresses.smb";
                  },400); 
            } else {
                alert('Sever Đã có Lỗi !!!');
            }
        }
    })
})

$(document).on('click','.address_smb_edit',function(){
    let id = $(this).attr('data-id');
    $('.address_'+id+'').removeClass('hidden-sm');
})

$(document).on('click','.submit_update_address',function(){
    let data = {};
    data.id = $(this).attr('data-id');
    data.fname = $('input[name="addr_fname"]').val();
    data.lname = $('input[name="addr_lname"]').val();
    data.tax = $('input[name="addr_tax"]').val();
    data.active = $('input[name="addr_active"]').length;
    data.info = $('input[name="addr_full_addr"]').val();
    $.ajax({
        type: "post",
        url: "/updateAddress",         
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        cache: false,
        data:data,
        success: function (data) {
            if (data.data == 1) {
                alert('Chỉnh Sửa Thành Công');
                setTimeout(function(){
                    window.location.href= "/account/view=addresses.smb";
                  },400); 
            } else {
                alert('Sever Đã có Lỗi !!!');
            }
        }
    })
})

$(document).on('click','.address_smb_delete',function(){
    id = $(this).attr('data-address');
    $.ajax({
        type: "post",
        url: "/deletaAddress/"+id,         
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        cache: false,
        success: function (data) {
            if (data.data == 1) {
                alert('Delete Thành Công');
                setTimeout(function(){
                    window.location.href= "/account/view=addresses.smb";
                  },400); 
            } 
            else if (data.data == 2) {
                alert('Không thể Xoá địa chỉ mặc định !!');
                setTimeout(function(){
                    window.location.href= "/account/view=addresses.smb";
                  },400); 
            }else {
                alert('Sever Đã có Lỗi !!!');
            }
        }
    })
})