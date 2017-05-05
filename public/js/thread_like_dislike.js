$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });

    $('#post_reply_form').submit(function(){
        console.log('here');
        return false;
    });

    $('#report_form').submit(function(){
        var report_type=$('input[name=report]:checked').val();
        var report_reason=$('textarea[name=report_description]').val();
        var thread_id=$('input[name=data]').val();
        var user_id=$('input[name=user]').val();

        console.log(report_reason);

        if(report_reason == ''){
            $('input[name=report_description]').toggleClass('has-error');
        }else{
            var data={
                'thread_id':thread_id,
                'user_id':user_id,
                'report_reason':report_reason,
                'report_type':report_type,
            };
            thread_report(data);
        }
        return false;

    });



    $('.clickable').click(function(){

        var id=$(this).attr('content');
        var type=$(this).attr('name');
        var selector_id=$(this).attr('id');
        var data=$(this).attr('data');
        var value=$(this).attr('value');
        // alert($(this).attr('name'));

        if(type == "thread_like_dislike"){
            thread_like_dislike(id,value,data,selector_id);
        }else if(type == "thread_report"){
            check_auth(value,selector_id,id);
        }else if(type == "comment_like_dislike"){
            like_dislike_comment(id,value,data,selector_id);
        }else{
            comment_report(id);
        }
    });


    function thread_like_dislike(id,value,data,selector_id){

        $.ajax({
            method:'POST',
            url:'/thread_like_dislike',
            data:{
                'thread_id':id,
                'like_dislike':value,
            },
            
            success:function (response) {
                console.log(response);
                if(response == true){
                    /*if data is saved successfully*/
                    if(value == 1){
                        //for like
                        if(data == 0){
                            $("#"+selector_id).attr('class','fa fa-thumbs-up clickable');
                            $("#"+selector_id).attr('data','1');

                            if($("#thread_1_"+id).attr('data') != 0 ){
                                /*for dislike off*/
                                $("#thread_1_"+id).attr('data','0');
                                $("#thread_1_"+id).attr('class','fa fa-thumbs-o-down flipped clickable');
                                var num=$("#thread_1_"+id).next().html();
                                num--;
                                $("#thread_1_"+id).next().html(num);
                                
                                // console.log(num);
                            }
                            num=$("#"+selector_id).next().html();
                            num++;
                            num=$("#"+selector_id).next().html(num);
                        }
                    }else{
                        //for dislike
                        if(data == 0){
                            $("#"+selector_id).attr('class','fa fa-thumbs-down flipped clickable');
                            $("#"+selector_id).attr('data','1');

                            if($("#thread_0_"+id).attr('data') != 0 ){
                                /*for like off*/
                                $("#thread_0_"+id).attr('data','0');
                                $("#thread_0_"+id).attr('class','fa fa-thumbs-o-up clickable');
                                var num=$("#thread_0_"+id).next().html();
                                num--;
                                $("#thread_0_"+id).next().html(num);
                            
                            }
                            num=$("#"+selector_id).next().html();
                            // console.log(num);
                            num++;
                            num=$("#"+selector_id).next().html(num);
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

    function thread_report(data){
        $.ajax({
            method:'POST',
            url:'/thread_report',
            data:data,
            
            success:function (response) {
                console.log(response);
                if(response == true){

                    $('#report_thread').modal('toggle');
                    
                    $("#thread_2_"+data.thread_id).attr('class','fa fa-flag clickable');
                    $("#thread_2_"+data.thread_id).attr('value','1');
                }

            },
            error: function(response){
                console.log('error '+response);
            }
        });
    }

    function like_dislike_comment(id,value,data,selector_id){
        $.ajax({
            method:'POST',
            url:'/comment_like_dislike',
            data:{
                'thread_comment_id':id,
                'like_dislike':value,
            },
            
            success:function (response) {
                console.log(response);
                if(response == true){
                    /*if data is saved successfully*/
                    if(value == 1){
                        //for like
                        if(data == 0){
                            $("#"+selector_id).attr('class','fa fa-thumbs-up clickable');
                            $("#"+selector_id).attr('data','1');

                            if($("#comment_1_"+id).attr('data') != 0 ){
                                /*for dislike off*/
                                $("#comment_1_"+id).attr('data','0');
                                $("#comment_1_"+id).attr('class','fa fa-thumbs-o-down flipped clickable');
                                var num=$("#comment_1_"+id).next().html();
                                num--;
                                $("#comment_1_"+id).next().html(num);
                            
                                // console.log(num);
                            }
                            num=$("#"+selector_id).next().html();
                            num++;
                            num=$("#"+selector_id).next().html(num);
                        }
                    }else{
                        //for dislike
                        if(data == 0){
                            $("#"+selector_id).attr('class','fa fa-thumbs-down flipped clickable');
                            $("#"+selector_id).attr('data','1');

                            if($("#comment_0_"+id).attr('data') != 0 ){
                                /*for like off*/
                                $("#comment_0_"+id).attr('data','0');
                                $("#comment_0_"+id).attr('class','fa fa-thumbs-o-up clickable');
                                var num=$("#comment_0_"+id).next().html();
                                num--;
                                $("#comment_0_"+id).next().html(num);
                            
                            }
                            num=$("#"+selector_id).next().html();
                            // console.log(num);
                            num++;
                            num=$("#"+selector_id).next().html(num);
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

    function del_report(id_selector,id){
        $.ajax({
            method:'POST',
            url:'/del_report',
            data:{
                'thread_id':id,
            },
            
            success:function (response) {
                console.log(response);
                if(response == true){
                    $("#"+id_selector).attr('class','fa fa-flag-o clickable');
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
                        $('#report_thread').modal();    
                    }else{
                        del_report(id_selector,id);
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