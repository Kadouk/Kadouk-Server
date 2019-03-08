$(function () {
	
        $('#fileupload1').fileupload({
	
            dataType: 'json',
            add: function (e, data) {
                $('#loading1').text('Uploading...' );

                data.submit();
            },
            done: function (e, data) {
                $.each(data.result.files, function (index, file) {
                    $('<p/>').html(file.name + ' (' + file.size + ' KB)').appendTo($('#files_list1'));
                    if ($('#file_ids1').val() != '') {
                        $('#file_ids1').val($('#file_ids1').val() + ',');
                    }
                    $('#file_ids1').val($('#file_ids1').val() + file.fileID);
                });
                $('#loading1').text( );

            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress1 .bar').css(
                    'width',
                    progress + '%'
                );
                 $('#loading1').text(progress);
            }
            
        });
    });