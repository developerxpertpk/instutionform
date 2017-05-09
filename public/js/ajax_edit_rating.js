
$(document).ready(function() {
    var school_id = $('input[name=hidden_input]').val();

    var user_id = $('input[name=hidden_input-user]').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // console.log(school_id);
    // console.log(user_id);

    $.ajax({
        url: '/admin/edit_ratings',
        type: 'POST',
        data: {
            "school_id": school_id,
            "user_id": user_id,
        },

        success: function (response) {
            //console.log('success');
            if (response.ratings) {

                $(".info").html('<h5> <b> </b>' + '<b>' + response.ratings + ' star </b> </h5>');
                $("input[value='" + response.ratings + "']").attr('checked', true);
                //$(".stars").off("click");

            }
        },
        error: function () {
           // console.log(response);
            console.log(' -- I m here error --');
        }

    });

    $("#reset").click(function () {

        $("input").attr('checked', false);
        $(".info").remove();

       // var school_id = $('input[name=hidden_input]').val();
       // var user_id = $('input[name=hidden_input-user]').val();
       // console.log(school_id);
      //  console.log(user_id);

        $("#demo1  .stars").click(function () {

            var rating = $(this).attr('value');
          //  console.log(rating);
          //  console.log(school_id);
           // console.log(user_id);
            $.ajax({
                type:'POST',
                url:'/admin/submit_rating',
                data:{
                    "school_id":school_id,
                    "user_id":user_id,
                    "ratings":rating,
                },

                success:function(response){

                    if(response.ratings) {

                        $(".info_edit").html('<h5> <b> </b>' + '<b>' + 'Updated ratings ' + response.ratings + ' star </b> </h5>');
                        $("input[value='" + response.ratings + "']").attr('checked', true);
                        $(".rating:not(:checked) > label:hover ~ label ").css({ color:black });

                        $(".stars").off("click");
                    }
                    if(response.error){
                        $(".info_edit").html('<h5> <b> </b>' + '<b>' + response.error + ' </b> </h5>');
                    }
                 console.log(response);
            },

            error:function(){
                    console.log('error in submit');
            },

            });

        });


    });

});