$(function(){
    getTablePost(); 
})
function getTablePost() {
    $.ajax({
        type: "POST",
        url: "/admin/post/postTable",
        cache: false,
        success: function (data) {
            if (data.data == 1) {
                $('#tablePost tbody').empty();
                let renderPostTable =[];
                $.each(data.renderPost, function (index, value) {
                    renderPostTable += '<tr><th scope="row">' + (index + 1) + '</td><th><img src="/upload/post/' + value.img + '" height="30px" width="30px"/></td><td>' + value.title + '</td>';
                    if(value.categories != null){
                        renderPostTable +='<td>' + add3Dots(value.categories,10) + '</td>'
                    }else{
                        renderPostTable +='<td>Không Có</td>'
                    }
                    renderPostTable +='<td>' + value.fullname + '</td><td>' + value.created_at + '</td><td><i class="fas fa-edit icon-table-edit" data-id="' + value.id + '"></i><i class="fas fa-trash-alt icon-table-delete" data-id="' + value.id + '"></i></td></tr>';
                })
                $('#tablePost tbody').html(renderPostTable);
            } else {
                $('#tablePost tbody').append('<tr><td> Đã có lỗi saỷ ra !!</td></tr>')
            }

        }
    })
}
function add3Dots(string, limit)
{
  var dots = "...";
  if(string.length > limit)
  {
    // you can also use substr instead of substring
    string = string.substring(0,limit) + dots;
  }

    return string;
}
