$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });



    $('#report_form').submit(function(){
        var report_type=$('input[name=report]:checked').val();
        var report_reason=$('textarea[name=report_description]').val();
        var forum_id=$('input[name=data]').val();
        var user_id=$('input[name=user]').val();

        console.log(report_reason);

        if(report_reason == ''){
            $('input[name=report_description]').toggleClass('has-error');
        }else{
            var data={
                'forum_id':forum_id,
                'user_id':user_id,
                'report_reason':report_reason,
                'report_type':report_type,
            };
            forum_report(data);
        }
        return false;

    });



    $('.clickables').click(function(){

        var id=$(this).attr('content');
        var type=$(this).attr('name');
        var selector_id=$(this).attr('id');
        var data=$(this).attr('data');
        var value=$(this).attr('value');
        // alert($(this).attr('name'));

        if(type == "forum_like_dislike"){
            forum_like_dislike(id,value,data,selector_id);
        }else if(type == "forum_report"){
            check_auth(value,selector_id,id);
        }/*else if(type == "comment_like_dislike"){
            like_dislike_comment(id,value,data,selector_id);
        }else{
            comment_report(id);
        }*/
    });


    function forum_like_dislike(id,value,data,selector_id){

        $.ajax({
            method:'POST',
            url:'/forum_like_dislike',
            data:{
                'forum_id':id,
                'like_dislike':value,
            },
            
            success:function (response) {
                console.log(response);
                if(response == true){
                    /*if data is saved successfully*/
                    if(value == 1){
                        //for like
                        if(data == 0){
                            $("#"+selector_id).attr('class','fa fa-thumbs-up clickables');
                            $("#"+selector_id).attr('data','1');

                            if($("#forum_1_"+id).attr('data') != 0 ){
                                /*for dislike off*/
                                $("#forum_1_"+id).attr('data','0');
                                $("#forum_1_"+id).attr('class','fa fa-thumbs-o-down flipped clickables');
                                var num=$("#forum_1_"+id).next().html();
                                num--;
                                $("#forum_1_"+id).next().html(num);
                                num=$("#"+selector_id).next().html();
                                num++;
                                num=$("#"+selector_id).next().html(num);
                                // console.log(num);
                            }
                        }
                    }else{
                        //for dislike
                        if(data == 0){
                            $("#"+selector_id).attr('class','fa fa-thumbs-down flipped clickables');
                            $("#"+selector_id).attr('data','1');

                            if($("#forum_0_"+id).attr('data') != 0 ){
                                /*for like off*/
                                $("#forum_0_"+id).attr('data','0');
                                $("#forum_0_"+id).attr('class','fa fa-thumbs-o-up clickables');
                                var num=$("#forum_0_"+id).next().html();
                                num--;
                                $("#forum_0_"+id).next().html(num);
                                num=$("#"+selector_id).next().html();
                                // console.log(num);
                                num++;
                                num=$("#"+selector_id).next().html(num);
                            }
                        }
                    }
                    
                }else if(response == 400){
                    console.log('not authenticated');
                    $('#edit_user').modal();
                }else{
                    //failed to save data
                    console.log('failed to save data');
                }

            },
            error: function(response){
                console.log('error '+response);
            }
        });

    }

    function forum_report(data){
        $.ajax({
            method:'POST',
            url:'/forum_report',
            data:data,
            
            success:function (response) {
                console.log(response);
                if(response == true){

                    $('#report_forum').modal('toggle');
                    
                    $("#forum_2_"+data.forum_id).attr('class','fa fa-flag clickables');
                    $("#forum_2_"+data.forum_id).attr('value','1');
                }

            },
            error: function(response){
                console.log('error '+response);
            }
        });
    }

    // function forum_like_dislike_comment(id,value,data,selector_id){
    //     $.ajax({
    //         method:'POST',
    //         url:'/forum_like_dislike_comment',
    //         data:{
    //             'forum_comment_id':id,
    //             'like_dislike':value,
    //         },
            
    //         success:function (response) {
    //             console.log(response);
    //             if(response == true){
    //                 /*if data is saved successfully*/
    //                 if(value == 1){
    //                     //for like
    //                     if(data == 0){
    //                         $("#"+selector_id).attr('class','fa fa-thumbs-up clickable');
    //                         $("#"+selector_id).attr('data','1');

    //                         if($("#comment_1_"+id).attr('data') != 0 ){
    //                             /*for dislike off*/
    //                             $("#comment_1_"+id).attr('data','0');
    //                             $("#comment_1_"+id).attr('class','fa fa-thumbs-o-down flipped clickable');
    //                             var num=$("#comment_1_"+id).next().html();
    //                             num--;
    //                             $("#comment_1_"+id).next().html(num);
    //                             num=$("#"+selector_id).next().html();
    //                             num++;
    //                             num=$("#"+selector_id).next().html(num);
    //                             // console.log(num);
    //                         }
    //                     }
    //                 }else{
    //                     //for dislike
    //                     if(data == 0){
    //                         $("#"+selector_id).attr('class','fa fa-thumbs-down flipped clickable');
    //                         $("#"+selector_id).attr('data','1');

    //                         if($("#comment_0_"+id).attr('data') != 0 ){
    //                             /*for like off*/
    //                             $("#comment_0_"+id).attr('data','0');
    //                             $("#comment_0_"+id).attr('class','fa fa-thumbs-o-up clickable');
    //                             var num=$("#comment_0_"+id).next().html();
    //                             num--;
    //                             $("#comment_0_"+id).next().html(num);
    //                             num=$("#"+selector_id).next().html();
    //                             // console.log(num);
    //                             num++;
    //                             num=$("#"+selector_id).next().html(num);
    //                         }
    //                     }
    //                 }
                    
    //             }else if(response == 400){
    //                 console.log('not authenticated');
    //                 $('#edit_user').modal();
    //             }else{
    //                 //failed to save data
    //                 console.log('failed to save data');
    //             }

    //         },
    //         error: function(response){
    //             console.log('error '+response);
    //         }
    //     });
        
    // }

    
    function forum_del_report(id_selector,id){
        $.ajax({
            method:'POST',
            url:'/forum_del_report',
            data:{
                'forum_id':id,
            },
            
            success:function (response) {
                console.log(response);
                if(response == true){
                    $("#"+id_selector).attr('class','fa fa-flag-o clickables');
                    $("#"+id_selector).attr('value','0');
                    console.log('report deleted');
                }else{
                    console.log('unable to delete report');
                }

            },
            error: function(response){
                console.log('error '+response);
            }
        });
    }

    function check_auth(value,id_selector,id){

        $.ajax({
            method:'POST',
            url:'/check_auth',
            
            success:function (response) {
                console.log(response);
                if(response == true){
                    if(value == 0){
                        $('#report_forum').modal();    
                    }else{
                        forum_del_report(id_selector,id);
                    }
                }else{  
                    $('#edit_user').modal();
                }

            },
            error: function(response){
                console.log('error '+response);
            }
        });

    }

});  