$('#content').on('click','#div-page a', function(){
    var url = $(this).attr('href');


    $.ajax({
        // url : '../users/managerusers.php',
        url : url,
        type : 'get',
        dataType: "json",
        success: function (result) {
            console.log(result);

            if (result.hasOwnProperty('query') && result.hasOwnProperty('paging'))
                    {
                    var html = '';
                    // lặp qua danh sách thành viên và tạo html
                    $.each(result['query'], function (key, row){
                        html += '<tr>';
                        html += '<td>'+row['username']+'</td>';
                        html += '<td>'+row['password']+'</td>';
                        html += '<td>'+row['email']+'</td>';
                        html += '<td>'+row['level']+'</td>';
                        html += '<td><i class=\"fas fa-edit"></i><i class="fas fa-backspace"></i></td>';
                        html += '</tr>';
                    });

                    html += '';

                    // Thay đổi nội dung danh sách thành viên
                    $('#list').html(html);

                    // Thay đổi nội dung phân trang
                    $('#div-page').html(result['paging']);

                    // Thay đổi URL trên website
                    window.history.pushState({path:url},'',url);
                }

        }



});

    return false;

});

