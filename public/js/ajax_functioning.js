
/*Ajax Calls and Requests here*/

$(document).ready(function(){

    $('.rating_box span').click(function(){
        var rating=$(this).attr('id');

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
                    rating_store(id,rating);
                }

            },

            error: function(response){
                console.log(response);
            }
        });
        //edit_user();
        //alert($(this).attr('id'));
    });

    window.rating_store = function(id,rating){

        $.ajax({

            url:'rate_school',
            type:'GET',
            data:{
                'id':id,
                'rating':rating,
            },

            success: function(response){

                console.log(response);

            },

            error: function(response){

                console.log(response);
            }

        });
    }

    window.edit_user = function(){
        $("#edit_user").modal();
    }
});