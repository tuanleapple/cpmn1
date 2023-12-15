// $(function () {
//     getTableLog();
// })

// function getTableLog() {
//     $.ajax({
//         type: 'GET',
//         url: '/admin/log/getTable',
//         cache: false,
//         success: function (data) {
//             if (data.data == 1) {
//                 $('#tableLog tbody').empty();
//                 $.each(data.log, function (index, value) {
//                     $('#tableLog tbody').append('<tr><td scope="row">' + (index + 1) + '</td><td>' + value.module + '</td><td>' + value.fullname + '</td><td>' + value.message + '</td><td>' + value.created_at + '</td></tr>')
//                 })
//             } else {
//                 $('#tableLog tbody').append('<tr><td> Đã có lỗi saỷ ra !!</td></tr>')
//             }
//         }
//     })
// }
