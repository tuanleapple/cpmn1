
$(document).on("click", "#site-exit", function () {
    let type = $(this).attr("data-type");
    if (type == 1) {
        $(".site-nav").removeClass("active");
        $(".site-overlay").removeClass("active");
        $("#site-seach").addClass("hidden-sm");
    }
    if (type == 2) {
        $(".site-nav").removeClass("active");
        $(".site-overlay").removeClass("active");
        $("#site-cart").addClass("hidden-sm");
    }
});

function openpopup(type){
    if (type == 1) {
        $(".site-nav").addClass("active");
        $(".site-overlay").addClass("active");
        $("#site-seach").removeClass("hidden-sm");
    }
    if (type == 2) {
        $(".site-nav").addClass("active");
        $(".site-overlay").addClass("active");
        $("#site-cart").removeClass("hidden-sm");
        
    }
}
function number_format (number, decimals, dec_point, thousands_sep) {
    // Strip all characters but numerical ones.
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
  }
$(function(){
    totalPrice();
  })
function totalPrice(){
let price = 0;
let lengthCart = $('.cart-product #cart-view').length;
for(let i = 0 ; i<lengthCart;i++){
    price += parseInt($('#cart-view .table-product-p span.pro-price-view').eq(i).attr('data-price')) * parseInt($('#cart-view .table-product-p span.pro-quantity-view').eq(i).html());
}
$('#total-view-cart').html(number_format(price,0,'',',')+'<u class="format_d">đ</u>');
}
$(document).on('input','#keyword',function(){
    console.log(123)
    let data = {};
    data.seacher = $(this).val();
    $.ajax({
        type: "POST",
        url: "/seacherOther",
        data: data,          
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        cache: false,
        success: function (data) {
            if (data.data == 1) {
                $('.result-sreach').empty();
                $.each(data.productSeacher,function(i,v){
                    $('.result-sreach').append('<div class="item-ult"><div class="thumb"><a href="/products/'+v.slug+'" title="'+v.title+'"><img src="./upload/product/'+v.image+'" alt="'+v.title+'" srcset=""></a></div><div class="title"><a href="/products/'+v.slug+'" class="" title="'+v.title+'">'+v.title+'</a><p class="f-initial">'+number_format(v.price,0,'',',')+'<u class="format_d">đ</u></p></div></div>')
                })
            } 
            else {
                alert('Sever Đã có Lỗi !!!');
            }
        }
    })
})