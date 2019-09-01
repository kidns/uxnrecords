/****
 * @author thanh depzai
 * @return load data + pagination
 *hàm bên dưới có chức năng gọi data và set pagination cho managerUser.php
 * sẽ được gọi khi khởi động page
 *
 *
 */
$(document).ready(function () {
    refresh();
});


/***
 * hàm bên dưới có nhiệm vụ phân trang cho page
 * khi click vào tag <a nó sẽ gửi request tới trang hiện tại là managerUsers
 * tính toán và nhận lại kết quả ở dạng JSON
 * khi có kết quả sẽ parse ra và thay  thế data vào #list
 *
 *
 *
 *
 */

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
 @return hàm này có nhiệm vụ show info hiện tại trước khi update
 được gán vào placeholder cho người dùng nhìn để chỉnh sửa dễ dàng hơn
 (chức năng chưa hoàn thiện)
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
* hàm này có nhiệm vụ xóa users.
 * khi set sự kiện onclick =  delete records nó sẽ show dialog confirm
 * khi xác nhận xóa thì nó gửi post kèm id tới deleteUsẻ.php
 * sau khi request gửi đi và sẽ trả về dạng text (sẽ fix sớm ở dạng json)
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

/***
 *
 * hàm bên dươi là hàm thêm users.
 * check form + gửi request tới Users để trả về kết quả ở dạng json.
 * chưa check được dạng email @......
 *
 * @return {boolean}
 */

function addRegister() {
    var username = $('#username').val();
    var email =  $('#email').val();
    var pws = $('#password').val();
    if($.trim(username)===''){

        $('#notifi').text('Enter a valid username!');
        $('#notifi').addClass('text-warning');
        $('#username').addClass('border-danger');

        return false;

    }
    else {
        $('#username').removeClass('border-danger');
        $('#notifi').text('');
    }
    if ($.trim(pws) === ''){

        $('#notifi').text('Enter a valid password!');
        $('#notifi').addClass('text-warning');
        $('#password').addClass('border-danger');
        return false;

    }else {

        $('#password').removeClass('border-danger');
        $('#notifi').text('');
    }
    if ($.trim(email)===''){

        $('#notifi').text('Enter a valid email!');
        $('#notifi').addClass('text-warning');
        $('#email').addClass('border-danger');
        return false;
    }else {
        $('#email').removeClass('border-danger');
        $('#notifi').text('');
    }

    $.ajax({
        url:'addUsers.php',
        type:'post',
        dataType:'json',
        data:{
            "username" : username,
            "password" :pws,
            "email" :email
        },
        success:function (result) {

         if($.trim(result['username'])!==""){

             $('#notifi').text(result['username']);
             $('#notifi').addClass('text-warning');
             $('#username').addClass('border-danger');

         }else if ($.trim(result['email']) !== "") {
             $('#notifi').text(result['email']);
             $('#notifi').addClass('text-warning');
             $('#email').addClass('border-danger');


         }else if ($.trim(result['success']!=="")){

             $('#notifi').text(result['success']);
             $('#notifi').addClass('text-info')
             setTimeout(function () {
                 $('#closeReg').click();
                 refresh();
             },7200);


         }



        }







    });
    return false;

}

/****
 * khi click vào close  = id closeReg
 * thì nó sẽ reset lại các giá trị của form trở về trạng thái ban đầu
 * khi chúng ta không click close đóng dialog bằng cách trỏ chuột ngoài màn hình thì nó
 * vẫn giữ nguyên thông tin đang nhập ở form (BUG = CHỨC NĂNG MỚI  :))
 *
 */
$('#closeReg').click(function () {
    console.log("vao day roi");
    $('#notifi').html('');
    $('#notifi').removeClass('border-danger');
    $('#username').val('');
    $('#password').val('');
    $('#email').val('');
})

/******
 * Refresh()
 * hàm này có chức năng refesh lại trang
 * còn hơi gà ở giai đoạn này
 *
 *
 *
 * @return {boolean}
 */
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


