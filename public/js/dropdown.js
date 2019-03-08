 $(document).ready(function() {

                        $('select[name="id_cat"]').append('<option value="'+ 'key' +'">' + 'value' + '</option>');

            $.ajax({
                url: 'get/cat',
                type:"GET",
                dataType:"json",
                beforeSend: function(){
                    $('#loader').css("visibility", "visible");
                },

                success:function(data) {

                    $('select[name="id_cat"]').empty();

                    $.each(data, function(key, value){

                        $('select[name="id_cat"]').append('<option value="'+ key +'">' + value + '</option>');

                    });
                },
                complete: function(){
                    $('#loader').css("visibility", "hidden");
                }
            });
      


});