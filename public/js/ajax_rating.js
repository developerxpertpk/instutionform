
$(document).ready(function(){

        $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var school_id = $('input[name=hidden_input]').val();

    $.ajax({
        method:'POST',
        url:'check_ratings',
        data:{
            "school_id":school_id,
        },
        success:function (response) {

            if(response.ratings){

                $("input[value='"+response.ratings+"']").attr('checked', true);
                $(".info").html('<h5> <b> You Rate </b>' + '<b>' + response.ratings + ' star </b> </h5>');
                $('.full').unbind();


            }else{

                user_rating();
            }

        },
        error:function(){
            console.log('error');
        }

    });


    function user_rating() {
        $("#demo1  .stars").click(function () {

            var rating = $(this).attr('value');
            var school_id = $('input[name=hidden_input]').val();
            $.ajax({
                method:'POST',
                url:'admin_rating',
                data:{
                    "school_id": school_id,
                    "rating": rating,
                },
                success: function (response) {
                    if(response.ratings) {

                        $(".info").html('<h5> <b> You Rate ' + response.ratings + ' star </b>');
                    }

                    if(response.rate) {
                        $(".info").html('<b> Thanks for your rating  </b>' + '<b>' + response.ratings + '</b>');
                    }
                },
                error: function (response){
                    console.log('error here');
                },

            });
        });

    }

});