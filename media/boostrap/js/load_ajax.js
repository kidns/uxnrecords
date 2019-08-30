$('#content').on('click', '#div-page a', function abc() {
    var url = $(this).attr('href');


    $.ajax({
        // url : '../users/managerusers.php',
        url: url,
        type: 'get',
        dataType: "json",
        success: function (result) {
            console.log(result);

            if (result.hasOwnProperty('query') && result.hasOwnProperty('paging')) {
                var html = '';
                // lặp qua danh sách thành viên và tạo html
                $.each(result['query'], function (key, row) {
                    html += '<tr>';
                    html += '<td>' + row['username'] + '</td>';
                    html += '<td>' + row['password'] + '</td>';
                    html += '<td>' + row['email'] + '</td>';
                    html += '<td>' + row['level'] + '</td>';
                    html += '<td class="text-center"><i class=\"fas fa-edit mr-3" id="' + row['username'] + '" data-toggle="modal" data-target="#update" onclick="showUpdate(this)" "></i>' +
                        '<i class="fas fa-backspace ml-3" id="'+row['username']+'" onclick="deleteRecord()"></i></td>';

                });

                html += '';

                // Thay đổi nội dung danh sách thành viên
                $('#list').html(html);

                // Thay đổi nội dung phân trang
                $('#div-page').html(result['paging']);

                // Thay đổi URL trên website
                window.history.pushState({path: url}, '', url);
            }

        }


    });

    return false;

});

function showUpdate(i) {
    var customUpdate = i.id;
    $.ajax({
            url: 'updateUsers.php',
            type: "get", dataType: "json",
            data: {"customUpdate": customUpdate},

            success: function (result) {

                $.each(result, function (key, row) {

                    $('#userUpdate').attr("placeholder", row["username"]);
                    $('#pwdUpdate').attr("placeholder", row["password"]);
                    $('#emailUpdate').attr("placeholder", row["email"]);

                })


            }


        }
    )
}

function deleteRecord() {

}




