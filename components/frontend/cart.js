
$(document).ready(function() {
  totalPrice();
    $('.minus').click(function () {
      var $input = $(this).parent().find('input');
      var count = parseInt($input.val()) - 1;
      count = count < 1 ? 1 : count;
      $input.val(count);
      checkTotalPrice($(this).parent().find('input').val(),$(this).parent().find('input').attr('data-price'),$(this).parent().find('input'),$(this).parent().find('input').attr('data-id'))
      $input.change();
      return false;
    });
    $('.plus').click(function () {
      var $input = $(this).parent().find('input');
      $input.val(parseInt($input.val()) + 1);
      checkTotalPrice($(this).parent().find('input').val(),$(this).parent().find('input').attr('data-price'),$(this).parent().find('input'),$(this).parent().find('input').attr('data-id'));
      $input.change();
      return false;
    });
});

function checkTotalPrice(qualyti,price,input,id){
    input.parent().parent().find('.price span.line-item-total').html((number_format(parseInt(price) * parseInt(qualyti),0,'',',')));
    input.parent().parent().find('.price span.line-item-total').attr('data-totalprice',parseInt(price)* parseInt(qualyti))
    totalPrice();
    let data ={};
    data.quality = qualyti;
     $.ajax({
      type: "POST",
      url: "/qualityPlus/"+id,
      data: data,          
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      cache: false,
  })

}
function totalPrice(){
  let lengthTable = $('table.table-cart').length;
  console.log(lengthTable);
  let total = 0;
  for(let i = 0;i<lengthTable;i++){
    total = total + parseInt($('table.table-cart tbody tr.line-item-container td.item .price .line-item-total').eq(i).attr('data-totalprice'));
  }
  $('.total_price b').html(number_format(total,0,'',','))
}
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
              let lengthTable = $('table.table-cart').length;
              $('.count-cart span').html(''+lengthTable+' Sản Phẩm ');
             
          }else{
            alert('Dã có lỗi xảy ra !!!');
          }
      }
  })
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