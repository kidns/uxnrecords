/**
 * LOAD DỮ LIỆU KHI KHỞI ĐỘNG PAGE
 *
 *
 */
$(document).ready(function () {
    $('#loading').show();
    refresh();
});


/***
 *
 *
 *
 *
 *PHÂN TRANG VÀ HIỂN THỊ NỘI DUNG
 *
 *
 */

$('#content').on('click', '#div-page a', function () {

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

                    html += '<div class="col-md-3 text-center mb-3 mt-3 col-sm-6">' +
                        '<div class="hovereffect">';
                    html += '<img class="img-responsive" src="' + row["cover"] + '" style="margin-bottom: -15%;z-index: -1; height: 199px;width: 100%;"  alt="UXN">';
                    html += '<button type="button" class="close text-right sticky-top" aria-label="Close" style="margin-top: -145px; margin-bottom: 70px;">' +
                        '<span id="' + row["id_artist"] + '" aria-hidden="true" onclick="del(this);" class="text-right pr-2">&times;</span></button>';
                    html += ' <div class="content-cover pb-3 pt-3">' + '<p class="card-text text-white font-weight-bold h6 mt-1 mb-1 small text-uppercase">' + row["name_artist"] + '</p>\n' + '</div></div></div>';


                });

                html += '';
                // Thay đổi nội dung danh sách thành viên
                $('#list').html(html);
                if ($('#list').html(html)) {
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
 *GET VÀ ADD DỰ LIỆU
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


                    html += '<div class="col-md-3 text-center mb-3 mt-3 col-sm-6">' +
                        '<div class="hovereffect">';
                    html += '<img class="img-responsive" src="' + row["cover"] + '" style="margin-bottom: -15%;z-index: -1; height: 199px;width: 100%;"  alt="UXN">';
                    html += '<button type="button" class="close text-right sticky-top" aria-label="Close" style="margin-top: -145px; margin-bottom: 70px;">' +
                        '<span id="' + row["id_artist"] + '" aria-hidden="true" onclick="del(this);" class="text-right pr-2">&times;</span></button>';
                    html += ' <div class="content-cover pb-3 pt-3">' + '<p class="card-text text-white font-weight-bold h6 mt-1 mb-1 small text-uppercase">' + row["name_artist"] + '</p>\n' + '</div></div></div>';


                });


                html += '';

                // Thay đổi nội dung danh sách thành viên
                $('#list').html(html);
                if ($('#list').html(html)) {
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


/**
 *Sự kiện khi click vào button #add-artist
 * Lấy hết val của input
 * xét các trường hợp xảy ra{
 * các trường trống
 * file k đúng format
 * size <= 3MB
 * }
 *nếu các trường bên trên bằng false thì sẽ tiến hành gửi
 * dữ liệu tới add.php
 * result sẽ trả về kiểu json xét các trường hợp hiển thị alert
 *
 *
 *
 */
$('#add_artist').click(function () {
    var name_art = $('#name_art').val();
    var booking = $('#booking').val();
    var sc__art = $('#sc_art').val();
    var fb__art = $('#fb_art').val();
    var inst__art = $('#inst_art').val();
    var spot_art = $('#spot_art').val();
    if (name_art === '') {
        $('#name_art').addClass('border-warning');


    } else {
        $('#name_art').removeClass('border-warning');
        $('.custom-file input[type="file"]').each(function () {
            if ($(this).val() === '') {
                $('#status').show();
                $('#status').text("upload file!");


            } else {
                var file_data = $('#file_cover').prop('files')[0];
                console.log(file_data);
                var type = file_data.type;
                var size = file_data.size;
                console.log(size);
                var match = ["image/gif", "image/png", "image/jpg", "image/jpeg"];
                if (type === match[0] && size <= Math.pow(10, 6) || type === match[1] && size <= Math.pow(10, 6) || type === match[2] && size <= Math.pow(10, 6) || type === match[3] && size <= Math.pow(10, 6)) {

                    var form_data = new FormData(this);
                    form_data.append('file', file_data);
                    form_data.append('name', name_art);
                    form_data.append('booking', booking);
                    form_data.append('sc_art', sc__art);
                    form_data.append('fb_art', fb__art);
                    form_data.append('inst_art', inst__art);
                    form_data.append('spot_art', spot_art);

                    $('#status').hide();
                    $.ajax({
                        url: 'add.php',
                        cache: false,
                        contentType: false,
                        processData: false,
                        type: 'post',
                        dataType: 'json',
                        data: form_data,
                        success: function (res) {
                            if (res['true'] !== '') {
                                $('#close_art').click();

                                setTimeout(function () {
                                    $.alert({
                                        icon: 'fa fa-check',
                                        title: res['true'],
                                        type: 'green',

                                    });

                                    refresh();
                                }, 1800)


                            }
                            if (res['false'] !== '') {
                                $.alert({
                                    icon: 'fas fa-exclamation',
                                    title: res['false'],
                                    type: 'red'

                                })


                            }


                        }


                    })


                } else {

                    $('#status').show();
                    $('#status').text("Please upload images (maximum: 3MB) ");

                }

            }
        });


    }

});

/****
 *
 *
 *
 *SET ẨN ALERT TRƯỚC KHI SỰ KIỆN ĐƯỢC BẮT ĐẦU
 *#status = trạng thái của img
 *#success = result của form.
 * #close_art = close dialog add artist
 * { khi click đóng dialog thì mọi thông tin của form sẽ bị reset lại
 * }
 *custom-file-input = custom lại input file upload cho đẹp hơn
 */
$('#status').fadeOut();
$('#success_add').fadeOut();
$('#close_art').click(function () {
    $(':input', '#form_art')
        .not(':button, :submit, :reset, :hidden')
        .val('')
        .prop('checked', false)
        .prop('selected', false);
    $('#status').hide();
    $('#name_art').removeClass('border-warning');
    $('#success_add').hide();
    $('#label-file').html('');
});
$(".custom-file-input").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

/***
 *
 * hàm xóa artist
 * gọi jax get info để gán vào dialog hiển thị cho người dùng biết đang
 * xóa artist nào
 * sau khi hiển thị dialog
 * nếu người dùng chọn xóa sẽ xóa luôn artist
 * sau khi xóa gọi hàm refesh
 *
 * @param span
 */
function del(span) {
    var id = span.id;
    var name = '';

    $.ajax({
        url: 'delete.php',
        type: 'post',
        data: {"getInfo": id},
        dataType: 'json',
        success: function (result) {
            $.each(result, function (key, row) {
                $('#del-art-dialog').html("<p>Are you sure delete <kbd>" + row['name_artist'] + "</kbd> ?</p>");
                name = row['name_artist'];
                $.confirm({
                    icon: 'fas fa-ban',
                    title: 'Confirm',
                    type: 'red',
                    content: 'Are you sure delete <b>' + row['name_artist'] + '</b> ?',
                    columnClass: 'col-md-4',
                    containerFluid:true,
                    buttons: {
                        yea: {
                            btnClass:'btn-danger text-white mr-3',
                            text: 'Yes!',
                            action: function () {

                                $.ajax({
                                    url: 'delete.php',
                                    type: 'post',
                                    data: {'customDelete': id},
                                    dataType: 'json',
                                    success: function (result) {
                                        if (result['true'] !== '') {
                                            $('#close-del-dialog').click();
                                            setTimeout(function () {
                                                $.alert({
                                                    icon: 'fa fa-check',
                                                    title: 'Successs!',
                                                    content: '<b>' + name + '</b>' + result['true'],
                                                    type: 'green',


                                                });
                                                refresh();
                                            }, 1800);


                                        }
                                        else if (result['false'] !== '') {

                                            $('#close-del-dialog').click();
                                            setTimeout(function () {
                                                $.alert({
                                                    icon: 'fas fa-exclamation',
                                                    title: 'Error!',
                                                    content: result['false'],
                                                    type: 'red'

                                                });
                                                refresh();
                                            }, 1800);


                                        }

                                    }


                                })


                            }

                        },
                        nope: {
                            text: 'Cancle',
                            btnClass: 'btn-primary text-white'
                        }

                    }


                })
            });
        }
    });
}

