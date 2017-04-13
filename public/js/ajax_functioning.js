/*Ajax Calls and Requests here*/

$(document).ready(function(){

    $("span").hover(function(){
        $(this).addClass("hhover");
    },function(){
        $(this).removeClass("hhover");
    });


    var school_id=$('input[name=hidden_input]').val();
    console.log(school_id);

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        url:'/check_rate',
        type:'POST',
        //datatype:'json',
        // processData:false,
        data:{
                'school_id':school_id,
            },

        success: function(response){
            console.log(response.ratings);

            if(response == false || response == 'not exist'){
                $('.school_main').append("<h5>Rate this school</h5>");

            }else{
                var i=1;
                var j=response.ratings;
                for(i=1; i<=j; i++){
                    $('#'+i).addClass('hover');
                    // console.log('a');
                }
                
                $("span").off("mouseout");

                // $("span").unbind('mouseenter mouseleave');
                // $("span").unbind('mouseenter').unbind('mouseleave')
                //$('#BoxId').unbind("click");
                $('.school_main').append("<h5>Thanks For your ratings</h5>");
            }
        },
        error:function(response){
            console.log('error: '+response);
        }
    });

    $('.rating_box span').click(function(){
        var rating=$(this).attr('id');
        var school_id=$('input[name=hidden_input]').val();

        $.ajax({
            url:'check_login',
            type:'GET',
            data:{'test':'test'},

            success: function(response){

                //console.log(response);

                if(response == false){

                    edit_user();

                }
                /*else if(isNaN(response)){
                    
                }*/
                else{

                    var id=response;
                    rating_store(school_id,rating);
                }

            },

            error: function(response){
                console.log(response);
            }
        });
        //edit_user();
        //alert($(this).attr('id'));
    });

    window.rating_store = function(school_id,rating){
        console.log(school_id);
        console.log(rating);

        $.ajax({

            url:'/rate_school',
            type:'POST',
            data:{
                "school_id":school_id,
                "rating":rating,
            },

            success: function(response){

                console.log(response);

                if(response == true){
                    console.log('rating successfull');

                }else{
                    console.log('Already Rated');
                }

            },

            error: function(response){

                console.log('error: '+response);
            }

        });
    }

    window.edit_user = function(){
        $("#edit_user").modal();
    }
});