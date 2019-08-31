/****
 * @author thanh depzai
 * @return table + pagination
 *
 *
 *
 */
$(document).ready(function () {
    refresh();
});

$('#content').on('click', '#div-page a', function() {

    var url = $(this).attr('href');


    $.ajax({
        url: url,
        type: 'get',
        dataType: "json",
        success: function (result) {
            console.log(result);

            if (result.hasOwnProperty('query') && result.hasOwnProperty('paging')) {
                var html = '';
                // lặp qua danh sách thành viên và tạo html
                $.each(result['query'], function (key, row) {
                    html += '<tr class="abx'+row["username"]+'">';
                    html += '<td>' + row['username'] + '</td>';
                    html += '<td>' + row['password'] + '</td>';
                    html += '<td>' + row['email'] + '</td>';
                    html += '<td>' + row['level'] + '</td>';
                    html += '<td class="text-center"><i class=\"fas fa-edit mr-3" id="' + row['username'] + '" data-toggle="modal" data-target="#update" onclick="showUpdate(this);" "></i>' +
                        '<i class="fas fa-backspace ml-3" id="'+row['username']+'" data-toggle="modal" data-target="#deleteUsers" onclick="deleteRecord(this);" ></i></td>';

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




/***
 @author thanh dep zai
 *
 @return show info in forms
 */



function showUpdate(i) {
    var customUpdate = i.id;
    $.ajax({
            url: 'updateUsers.php',
            type: "get",
            dataType: "json",
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

/***
@author thanh dep zai
* this below is a delete ajax funtion
*
*
* */
function deleteRecord(i) {
    var  id = i.id;
    $('#deleteDialog').html("<p>Are you sure want to delete <kbd> "+id+"</kbd>?</p>")
    $('#delBnt').click(function () {
        $.ajax({
            url:'deleteUsers.php',
            type:"post",
            dataType:"text",
            data:{"customDelete":id},
            success:function (result) {
                    if (result=="true"){
                        $('.toast-body').text(id+" was deleted successfully");
                        $('.close').click();
                        $('.toast').toast('show');
                        $('#alert').fadeOut(3600,function () {
                            refresh();
                        });



                    }else if (result=="false"){
                        $('.toast-body').text("Something went wrong!");
                        $('.close').click();

                    }
            }




        })

    })


}



function refresh() {
    var url = $(window.location).attr('href');


    $.ajax({
        url: url,
        type: 'get',
        dataType: "json",
        success: function (result) {
            console.log(result);

            if (result.hasOwnProperty('query') && result.hasOwnProperty('paging')) {
                var html = '';
                // lặp qua danh sách thành viên và tạo html
                $.each(result['query'], function (key, row) {
                    html += '<tr class="abx'+row["username"]+'">';
                    html += '<td>' + row['username'] + '</td>';
                    html += '<td>' + row['password'] + '</td>';
                    html += '<td>' + row['email'] + '</td>';
                    html += '<td>' + row['level'] + '</td>';
                    html += '<td class="text-center"><i class=\"fas fa-edit mr-3" id="' + row['username'] + '" data-toggle="modal" data-target="#update" onclick="showUpdate(this)" "></i>' +
                        '<i class="fas fa-backspace ml-3" id="'+row['username']+'" data-toggle="modal" data-target="#deleteUsers" onclick="deleteRecord(this)" ></i></td>';

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

}


