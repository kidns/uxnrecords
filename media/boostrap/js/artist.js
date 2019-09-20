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
                    html += '<img class="img-responsive" src="' + row["cover"] + '" style="margin-bottom: -15%;z-index: -1; height: 180px;width: 100%;"  alt="UXN">';
                    html += '<button type="button" class="close text-right sticky-top" aria-label="Close" style="margin-top: -145px; margin-bottom: 70px;">' +
                        '<span id="' + row["id_artist"] + '" aria-hidden="true" onclick="del(this);" class="text-right pr-2">&times;</span></button>';
                    html += ' <div class="content-cover pb-3 pt-3">' + '<p class="card-text text-white font-weight-bold h6 mt-1 mb-1 small text-uppercase">' + row["name_artist"] + '</p>\n' + '</div></div></div>';


                });

                html += '';
                // Thay đổi nội dung danh sách thành viên
                $('#list').html(html);
                if ($('#list').html(html)) {
                    $('#loading').fadeOut();
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
                    html += '<img class="img-responsive" src="' + row["cover"] + '" style="margin-bottom: -15%;z-index: -1; height: 180px;width: 100%;"  alt="UXN">';
                    html += '<button id="' + row['cover'] + '" type="button" class="close text-right sticky-top" aria-label="Close" style="margin-top: -145px; margin-bottom: 70px;">' +
                        '<span id="' + row["id_artist"] + '" aria-hidden="true" onclick="del(this);" class="text-right pr-2">&times;</span></button>';
                    html += ' <div class="content-cover pb-3 pt-3" id="damn">' + '<p onclick="update(this);" id="' + row['id_artist'] + '" class="card-text text-white font-weight-bold h6 mt-1 mb-1 small text-uppercase">'
                        + row["name_artist"] + '</p>\n' + '</div></div></div>';


                });


                html += '';

                // Thay đổi nội dung danh sách thành viên
                $('#list').html(html);
                if ($('#list').html(html)) {
                    $('#loading').fadeOut();
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

$('#add_artist').on('click', function () {
    var name_art = $('#name_art').val();
    var booking = $('#booking').val();
    var sc__art = 'https://soundcloud.com/' + $('#sc_art').val();
    var fb__art = 'https://facebook.com/' + $('#fb_art').val();
    var inst__art = 'https://instagram.com/' + $('#inst_art').val();
    var spot_art = 'https://spotify.com/' + $('#spot_art').val();
    if (name_art === '') {
        $('#name_art').addClass('border-warning');

    } else {
        $('#name_art').removeClass('border-warning');
        $('.add-file-artist input[type="file"]').each(function () {
            if ($(this).val() === '') {
                $('#status').show();
                $('#status').text("upload file!");

            } else {
                var file_data = $('#file_cover').prop('files')[0];
                var type = file_data.type;
                var size = file_data.size;
                var limit = 3 * Math.pow(10, 6);
                var match = ["image/gif", "image/png", "image/jpg", "image/jpeg"];
                if (type === match[0] && size <= limit || type === match[1] && size <= limit || type === match[2] && size <= limit || type === match[3] && size <= limit) {

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
                                close_dialog();
                                $.alert({
                                    icon: 'fa fa-check',
                                    title: 'Success',
                                    content: res['true'],
                                    type: 'green',

                                });

                                refresh();


                            }
                            if (res['false'] !== '') {
                                $.alert({
                                    icon: 'fas fa-exclamation',
                                    content: res['false'],
                                    title: 'Failed!',
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
                    containerFluid: true,
                    buttons: {
                        yea: {
                            btnClass: 'btn-dark text-white mr-3',
                            text: 'Yes',
                            action: function () {

                                $.ajax({
                                    url: 'delete.php',
                                    type: 'post',
                                    data: {'customDelete': id},
                                    dataType: 'json',
                                    success: function (result) {
                                        if (result['true'] !== '') {
                                            $('#close-del-dialog').click();
                                            $.alert({
                                                icon: 'fa fa-check',
                                                title: 'Successs!',
                                                content: '<b>' + name + '</b>' + result['true'],
                                                type: 'green',


                                            });
                                            refresh();


                                        }
                                        else if (result['false'] !== '') {

                                            $('#close-del-dialog').click();
                                            $.alert({
                                                icon: 'fas fa-exclamation',
                                                title: 'Error!',
                                                content: result['false'],
                                                type: 'red'

                                            });


                                        }

                                    }


                                })


                            }

                        },
                        nope: {
                            text: 'Cancle',
                            btnClass: 'btn-dark text-white'
                        }

                    }


                })
            });
        }
    });
}

/****
 * sự kiện update
 *
 *
 */
function update (p) {
    $('#modal-update-artist').modal({
        show: true
    });
    var id = p.id;
    var id_artist;
    var old_file_cover;
    console.log(id);
    var xhr = new XMLHttpRequest();


    $.ajax({
        url: 'update.php',
        type: 'post',
        dataType: 'json',
        data: {'getInfo': id},
        success: function (result) {
            $.each(result, function (key, row) {

                $('#update-name-art').attr('value', row['name_artist']);
                $('#update-booking').attr('value', row['booking']);
                $('#update-label-file').text(row['cover'].slice(21, 70));
                $('#up-sc-art').attr('value', row['sc_art'].slice(23, 70));
                $('#up-fb-art').attr('value', row['fb_art'].slice(21, 70));
                $('#up-inst-art').attr('value', row['inst_art'].slice(22, 70));
                $('#up-spot-art').attr('value', row['spot_art'].slice(20, 70));
                id_artist = row['id_artist'];
                old_file_cover = row['cover'];
                console.log(id_artist);

            });
            $('#update-name-art').on('change keyup', function () {
                $('#update-name-art').attr('value', $(this).val());


            });
            $('#update-booking').on('change keyup', function () {
                $('#update-booking').attr('value', $(this).val());

            });
            $('#up-sc-art').on('change keyup', function () {
                $('#up-sc-art').attr('value', $(this).val());

            });
            $('#up-fb-art').on('change keyup', function () {
                $('#up-fb-art').attr('value', $(this).val());

            });
            $('#up-inst-art').on('change keyup', function () {
                $('#up-inst-art').attr('value', $(this).val());

            });
            $('#up-spot-art').on('change keyup', function () {
                $('#up-spot-art').attr('value', $(this).val());

            });
                $('#bnt-update-artist').on('click', function (e) {
                    e.preventDefault();
                    e.stopImmediatePropagation();

                    var up_name = $('#update-name-art').val();
                    var up_booking = $('#update-booking').val();
                    var up_sc_art = 'https://soundcloud.com/' + $('#up-sc-art').val();
                    var up_fb_art = 'https://facebook.com/' + $('#up-fb-art').val();
                    var up_inst_art = 'https://instagram.com/' + $('#up-inst-art').val();
                    var up_spot_art = 'https://spotify.com/' + $('#up-spot-art').val();
                    var bntUpdate = $('#bnt-update-artist').val();
                    if (up_name === '') {
                        $.alert({
                            icon: 'far fa-times-circle',
                            title: 'Warning',
                            content: 'Enter a valid artist name!',

                        });
                    } else {

                        $('.update-file-artist input[type="file"]').each(function () {
                            var form_data = new FormData(this);
                            if ($(this).val() === '') {

                            } else {
                                var file_data = $('#update-file_cover').prop('files')[0];
                                var type = file_data.type;
                                var size = file_data.size;
                                var match = ["image/gif", "image/png", "image/jpg", "image/jpeg"];

                                if (type === match[0] && size <= Math.pow(10, 6) || type === match[1] && size <= Math.pow(10, 6) || type === match[2] && size <= Math.pow(10, 6) || type === match[3] && size <= Math.pow(10, 6)) {

                                    form_data.append('file', file_data);

                                } else {
                                    $.alert({
                                        title: 'Failed',
                                        content: 'Please upload images (maximum: 3MB)'
                                    });



                                }
                            }

                            form_data.append('id_up', id_artist);
                            form_data.append('up_name', up_name);
                            form_data.append('up_booking', up_booking);
                            form_data.append('up_sc_art', up_sc_art);
                            form_data.append('up_fb_art', up_fb_art);
                            form_data.append('up_inst_art', up_inst_art);
                            form_data.append('up_spot_art', up_spot_art);
                            form_data.append('old_file_cover', old_file_cover);
                            form_data.append('bnt_update', bntUpdate);
                            $.ajax({
                                url: 'update.php',
                                cache: false,
                                contentType: false,
                                processData: false,
                                dataType: 'json',
                                type: 'post',
                                data: form_data,
                                success: function (result) {

                                    if (result['true'] !== '') {
                                        close_dialog();
                                        $('#close-dialog-update').click();
                                        $.alert({
                                            type: 'green',
                                            title: 'Success!',
                                            content: result['true']
                                        });
                                        refresh();


                                    }else if (result['false'] !== '') {
                                        $.alert({
                                            type: 'red',
                                            title: 'Fail!',
                                            content: result['false']
                                        });


                                    }


                                }

                            });
                            return false;
                        })


                    }

                })



        }
    });


}

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
$('#close-dialog-update').click(function () {
    close_dialog();
});
$('#modal-update-artist').on('hidden.bs.modal',function () {
    close_dialog();
});


$('#status').fadeOut();
$('#success_add').fadeOut();

function close_dialog() {
    $(':input', '#form_art')
        .not(':button, :submit, :reset, :hidden')
        .val('')
        .prop('checked', false)
        .prop('selected', false);

    $(':input', '#update-form-art')
        .not(':button, :submit, :reset, :hidden')
        .val('')
        .prop('checked', false)
        .prop('selected', false);
    $('#status').hide();
    $('#name_art').removeClass('border-warning');
    $('#success_add').hide();
    $('#label-file').html('choose cover');

};
$(".custom-file-input").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

