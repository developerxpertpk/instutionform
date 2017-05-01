

$(document).ready(function(){

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
            console.log('check rate success: '+response);

            if(response == false || response == 'not exist'){
                $('.school_main').append("<h5 class='rating_heading'>Rate this school</h5>");

            }else{
                var i=1;
                var j=response.ratings;
                // console.log(j);

                rate(j);
                // $("input[class='stars']").unbind( "click" );
                $('.school_main').append("<h5>Thanks For your ratings</h5>");
            }
        },
        error:function(response){
            console.log('error check rate: '+response);
        }
    });





    $("#demo3 .stars").click(function () {

        var rating=$(this).attr('value');
        
        var school_id=$('input[name=hidden_input]').val();

        var label = $("label[for='" + $(this).attr('id') + "']");

        $.ajax({
            url:'check_login',
            type:'GET',
            data:{'test':'test'},

            success: function(response){


                if(response == false){
                    // $(this).attr("unchecked");
                    $('#starzero3').prop('checked', true);
                    edit_user();
                }
                /*else if(isNaN(response)){
                    
                }*/
                else{
                    rating_store(school_id,rating);
                }

            },

            error: function(response){
                console.log('error in check login: '+response);
            }
        });
        
    });






    function rating_store(school_id,rating){
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

                console.log(response.ratings);

                if(response == true){
                    console.log('rating successfull');
                    $( ".rating_heading" ).replaceWith( "<h5>Thanks For your ratings</h5>" );
                    rate(response.ratings);

                }else{
                    console.log('Already Rated');
                    rate(response.ratings);
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



    function rate(value){
        console.log(value);
        $("input[value='"+value+"']").prop('checked', true);
    }





    /*Bookmark functionality*/
    $('#bookmark_icon').click(function(){
        var school_id=$(this).attr('title');
        // alert(school_id);

        $.ajax({
            url:'/check_bookmark',
            type:'POST',
            data:{
                'school_id':school_id,
            },

            success: function(response){
                console.log('success check_bookmark: '+response);

                if(response == false){
                    console.log('You are not Logged in');
                    edit_user();
                }else if(response == 500){
                    console.log('You have been blocked');
                }else{
                    console.log(response);
                    $('#bookmark_icon').toggleClass('bookmark_class');
                    $('#bookmark_icon').toggleClass('bookmark_icon_glow');
                }
            },
            error: function(response){
                console.log('error check_bookmark: '+response);
            }
        });
    });

    /*for user bookmarks*/
    /*for Styling*/
    $('.delete_user_bookmark').hover(function(){
      $(this).attr('class','fa fa-trash delete_user_bookmark');
      $(this).css('font-size','25px');
    },function(){
      $(this).attr('class','fa fa-trash-o delete_user_bookmark');
      $(this).css('font-size','20px');
    });

    /*for deletion*/
    $('.delete_user_bookmark').click(function(){
      var bookmark_id=$(this).attr('id');
      var school_name=$(this).parent().prev().prev().prev().prev().html();
      var row_id=$(this).parent().parent().attr('id');

      var confrm = confirm('Do you really want to delete this bookmark? ('+school_name+')');
      
      if(confrm == true){
        console.log('here');
        $.ajax({
          url:'/bookmark_school_delete',
          method:'POST',
          data:{
            'bookmark_id':bookmark_id,
          },

          success:function(response){
            if(response == 404){
              console.log('doesnot exists');
            }else{
              console.log(true);
              $('#'+row_id).hide();
            }
          },
          error:function(response){
            console.log('error: '+response);
          }
        })
      }
    });
});