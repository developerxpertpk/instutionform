
/*Ajax Calls and Requests here*/

$(document).ready(function(){

    $.ajax({
        url:'check_rate',
        type:'GET',
        data:'{test:null}',
        success: function(response){
            console.log("span#"+response.ratings);
            if(response != false){

               $("span").addClass("stars-rating");
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
            data:'{test:null}',

            success: function(response){

                console.log(response);

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

        $.ajax({

            url:'rate_school',
            type:'GET',
            data:{
                'school_id':school_id,
                'rating':rating,
            },

            success: function(response){

                console.log(response);

                if(response == true){
                    console.log('rating successfull');
                    $("span#"+rating).trigger("mouseover");
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