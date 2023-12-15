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
$(document).on('click','.step-footer-continue-btn',function(){
    let data = {};
    data.fullname = $('#billing_address_full_name').val();
    data.email = $('#checkout_user_email').val();
    data.phone = $('#billing_address_phone').val();
    data.address = $('#billing_address_address1').val();
    data.tax = $('#billing_address_phone').val();
    data.city = $('select[name="customer_shipping_province"]').find('option:selected').val();
    data.district = $('select[name="customer_shipping_district"]').find('option:selected').val();
    data.ward = $('select[name="customer_shipping_ward"]').find('option:selected').val();
    let lengthTable = $('.product-table').length;
    let checkCart = [];
    console.log(data)
    if(data.fullname.length == 0 || data.email.length == 0 || data.phone.length == 0 || data.address.length == 0|| data.tax.length == 0 ||data.city == -1||data.district == -1 ||data.ward == -1 ){
        alert('Vui Lòng Điền Đầy Đủ Thông Tin !!');
        return;
    }
    for(let i = 0 ; i<lengthTable ;i++){
        checkCart.push($('.product-table tbody tr.product').eq(i).attr('data-cart'));
    }
    data.cart = checkCart;
    $.ajax({
        type: "POST",
        url: "/checkouts/cart",
        data:data,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        cache: false,
        success: function (data) {
            if (data.data == 1) {
                alert('Thanh Toán Thành Công');
                setTimeout(function(){
                    window.location.href= "";
                  },400); 
            } else {
                alert('Sever Đã có Lỗi !!!');
            }
        }
    })
})
function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}