
$(document).ready(function () {
refresh();
});


/***
 *
 *
 *
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

            if (result.hasOwnProperty('query') && result.hasOwnProperty('paging')) {
                var html = '';
                // lặp qua danh sách thành viên và tạo html
                $.each(result['query'], function (key, row) {

                    html+='<div class="col-md-2 text-center mb-3 mt-3 col-sm-12">' +
                        '<div class="card w-100">';
                    // style="background-image: url('+row['cover']+'); background-repeat: no-repeat; background-size: cover;background-position: center;
                    html+='<img src="'+row["cover"]+'" style="width: 100%; height: 10rem"  alt="UXN">';
                    html+='<button type="button" class="close text-right" aria-label="Close" style="margin-top: -155px; margin-bottom: 70px;">' +
                        '<span aria-hidden="true" class="text-right pr-2">&times;</span></button>';
                    html+=' <div class="card-body">' + '<p class="card-text">' +row["name_artist"]+'</p>\n' +'</div></div></div>';


                });

                html += '';
                // Thay đổi nội dung danh sách thành viên
                $('#list').html(html);
                if($('#list').html(html)){
                    $('#loading').hide();
                }
                // Thay đổi nội dung phân trang
                $('#div-page').html(result['paging']);

                // Thay đổi URL trên website
                window.history.pushState({path: url}, '', url);
            }

        }


    });

    return false;

});


/****
 *
 *
 *
 *
 *
 *
 *
 * @return {boolean}
 */
function refresh() {
    var url = $(this).attr('href');


    $.ajax({
        url: url,
        type: 'get',
        dataType: "json",
        success: function (result) {

            if (result.hasOwnProperty('query') && result.hasOwnProperty('paging')) {
                var html = ''

                $.each(result['query'], function (key, row) {


                    html+='<div class="col-md-2 text-center mb-3 mt-3 col-sm-12">' +
                        '<div class="card w-100">';
                    // style="background-image: url('+row['cover']+'); background-repeat: no-repeat; background-size: cover;background-position: center;
                    html+='<img src="'+row["cover"]+'" style="width: 100%; height: 10rem"  alt="UXN">';
                    html+='<button type="button" class="close text-right" aria-label="Close" style="margin-top: -155px; margin-bottom: 70px;">' +
                        '<span aria-hidden="true" class="text-right pr-2">&times;</span></button>';
                    html+=' <div class="card-body">' + '<p class="card-text">' +row["name_artist"]+'</p>\n' +'</div></div></div>';




                });


                html += '';

                // Thay đổi nội dung danh sách thành viên
                $('#list').html(html);
                if($('#list').html(html)){
                    $('#loading').hide();
                }

                // Thay đổi nội dung phân trang
                $('#div-page').html(result['paging']);

                // Thay đổi URL trên website
                window.history.pushState({path: url}, '', url);
            }

        }


    });

    return false;
}


/****
 *
 *
 *
 *
 *
 *
 */

$('#add_artist').click(function () {
    var name_art = $('#name_art').val();
    var booking = $('#booking').val();
    var sc__art = $('#sc_art').val();
    var sc__art = $('#sc_art').val();
    var file_data = $('#file_cover').prop('files')[0];
    var type = file_data.type;
    var match = ["image/gif", "image/png", "image/jpg","image/jpeg"];

    if (type === match[0] || type === match[1] || type === match[2] || type===match[3]) {

        var form_data = new FormData(this);
        form_data.append('file',file_data);
        form_data.append('name',name_art);
        form_data.append('booking',booking);
        $.ajax({
            url:'add.php',
            cache:false,
            contentType:false,
            processData:false,
            type:'post',
            dataType:'json',
            data: form_data,
            success:function (res) {



            }


            })


    }


});

$(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});