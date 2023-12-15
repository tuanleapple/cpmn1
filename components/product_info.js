

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}

$(document).ready(function(){
  $('.zoom').zoom();
});
$(document).ready(function() {
  $('.minus').click(function () {
    var $input = $(this).parent().find('input');
    var count = parseInt($input.val()) - 1;
    count = count < 1 ? 1 : count;
    $input.val(count);
    $input.change();
    return false;
  });
  $('.plus').click(function () {
    var $input = $(this).parent().find('input');
    $input.val(parseInt($input.val()) + 1);
    $input.change();
    return false;
  });
});

$(function(){
  $('.select-swap-sm .select-wrap label:not(.soldout)').eq(0).addClass('sd');
})
$(document).on('click','.checksize',function(){
  let lengthselect = $('.select-swap-sm .select-wrap').length;
  for(let i = 0 ;i <lengthselect ;i++){
  $('.select-swap-sm .select-wrap label').eq(i).removeClass('sd');
  }
   $(this).addClass('sd');
})

$(document).on('click','#add-to-cart',function(){
  let data = {};
  data.id= $(this).attr('data-id');
  data.quality = $('input.quality').val();
  data.price = $('.price').attr('data-price');
  let lengthselect = $('.select-swap-sm .select-wrap').length;
  for(let i = 0 ;i <lengthselect ;i++){
    data.size = $('.select-swap-sm .select-wrap .swatch-element label.sd').attr('data-value');
  }
  if(data.size.length == 0){
    alert('vui lòng chọn size!!!');
    return;
  }
  if(data){
      $.ajax({
          type:'POST',
          url:'/addCart',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          data:data,
          success:async function (data) {
              if (data.data == 1) {
                  if(data.cart){
                   await $('.cart-product').prepend('<table id="cart-view" class="table text-center border-table"><tbody><tr class="item_2"><td class="img"><a href="/products/'+data.cart.slug+'" title="/products/'+data.cart.slug+'"><img src="/upload/product/'+data.cart.image+'" alt="/products/'+data.cart.slug+'"></a></td><td class="table-product-p"><a class="pro-title-view" href="/products/'+data.cart.slug+'" title="/products/'+data.cart.slug+'}">'+data.cart.title+'</a><span class="variant">'+data.cart.size+'</span>	<span class="pro-quantity-view">'+data.cart.quality+'</span><span class="pro-price-view" data-price="'+data.cart.price+'">'+number_format(data.cart.price,0,'',',')+'<u class="format_d">đ</u></span><span class="remove_link remove-cart"><a onclick="deleteCart('+data.cart.id+')" ><i class="fa fa-times"></i></a></span></td></tr></tbody></table>')
                    openpopup(2)
                    totalPrice();
                  }
                 
              }else{
                alert('Dã có lỗi xảy ra !!!');
              }
          }
      })
  }
})

function deleteCart(e){
  let data = {};
  data.cart = e;
  if(data.cart){
    $.ajax({
      type:'POST',
      url:'/deleteCart',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data:data,
      success:async function (data) {
          if (data.data == 1) {
            $('.cart_'+e+'').remove();
                totalPrice();
             
          }else{
            alert('Dã có lỗi xảy ra !!!');
          }
      }
  })
  }
}