<!DOCTYPE html><!--Final Design-->
<html>
    <head>
        <title>School Finder</title>       
        
        
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" href="{{asset('css/forum.css')}}">
        <link rel="stylesheet" href="{{ asset('css/custom_project.css')}}">
        <link rel="stylesheet" href="{{ asset('css/custom.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/coding.css') }}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/toastr.css')}}">
        <!-- close -->

        <!-- js scripts  -->
        <script src="{{asset('js/app.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/toastr.min.js')}}" type="text/javascript"></script>
        <!-- /js scripts close -->

        <link rel="shortcut icon" href="/css/style.css">

        <!-- CSRF Tokken for ajax -->
        <meta name="_token" content="{{ csrf_token() }}">
        <!-- /CSRF Tokken for ajax -->
        <style>
        .margin_bottom{
            margin-bottom: 10px !important;
        }
        </style>
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>
    </head>
    <body>
        <header>
            <div class="container-fluid navigation ">
                <!-- Static navbar -->
                <nav class="navbar navbar-default">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('image\finallogo.png')}}"></a>
                        </div>
                        <div id="navbar" class="navbar-collapse collapse">
                            <ul class="nav navbar-nav">                                   

                                <li><a class="nav_control" href="{{url('/schools_list')}}">List of Schools</a></li>

                                @if(isset($page))
                                    @foreach($page as $pages)
                                        <li><a class="nav_control" href="{{url('/'.$pages->slug)}}">{{$pages->title}}</a></li>
                                    @endforeach
                               @endif

                               <li><a class="nav_control" href="{{url('/FAQ')}}">FAQ</a></li>
                               <li><a class="nav_control" href="{{url('/forum')}}">Forum</a></li>
                            </ul>

                            <ul class="nav navbar-nav navbar-right">
                                @if(Route::has('login'))
                                    @if (Auth::check())
                                        
                                        <li class="">
                                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            @if( !empty(Auth::user()->image) && File::exists('upload/users/user_'.Auth::id().'/images/profile_pic/current_dp/'.Auth::user()->image) )
                                                <img src="{{ asset('upload/users/user_'.Auth::id().'/images/profile_pic/current_dp/'.Auth::user()->image) }}">      
                                            @else
                                                <img src="{{ asset('images/user.png') }}">  
                                            @endif
                                                {{Auth::user()->fname." ".Auth::user()->lname}}
                                                <span class=" fa fa-angle-down"></span>
                                            </a>
                                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                                <li><a href="{{url('/home/my_profile')}}"> Profile</a></li>
                                                <li>
                                                    <a href="{{url('/bookmarks')}}">
                                                        <span><i class="fa fa-star pull-right" aria-hidden="true"></i>Bookmarks</span>
                                                    </a>
                                                </li>
                                                @if(Auth::user()->role_id == 1)
                                                    <li><a href="{{url('/admin/dashboard')}}">Admin</a></li>
                                                @endif
                                                <li>
                                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        {{ csrf_field() }}
                                                    </form>
                                                </li>
                                            </ul>
                                        </li>
                                    @else
                                        <li><a class="nav_control" href="{{ url('/login') }}">Login</a></li>
                                        <li><a class="nav_control" href="{{ url('/register') }}">Register</a></li>
                                    @endif
                                @endif
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </header>

        @yield('user_content')
        
        <!-- <div class="footer_bottom_margin">
            
        </div> -->
        <!--Footer Portion-->
        <footer id="footer" class="dark">
            <div class="secondary-footer">
                <div class="container">
                    <div>
                        <div class="col-md-12 text-color pull-left">
                            <span>© 2017 By 
                                <a href="http://www.talentelgia.com/" target="_blank" class="text-color">Talentelgia Technologies Pvt. Ltd.</a> All Rights Reserved </span>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <script type="text/javascript">
            @if(Session::has('message'))
                var type = "{{ Session::get('alert-type', 'info') }}";
                switch(type){
                    case 'info':
                        toastr.info("{{ Session::get('message') }}");
                        break;
                    
                    case 'warning':
                        toastr.warning("{{ Session::get('message') }}");
                        break;

                    case 'success':
                        toastr.success("{{ Session::get('message') }}");
                        break;

                    case 'error':
                        toastr.error("{{ Session::get('message') }}");
                        break;
                }
              @endif
        </script>

        <!-- Ajax Script -->
        <script type="text/javascript" charset="utf-8" >

           /*Forum js*/
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
                    }
                });


                function forum_like_dislike(id,value,data,selector_id){

                    $.ajax({
                        method:'POST',
                        url:"{{url('/forum_like_dislike')}}",
                        data:{
                            'forum_id':id,
                            'like_dislike':value,
                        },
                        
                        success:function (response) {
                            console.log(response);
                            if(response == true){
                                /*if data is saved successfully*/
                                if(value == 1){
                                    console.log(id+' '+value+' '+data+' '+selector_id+' ');
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
                                            // console.log(num);
                                        }
                                        num=$("#"+selector_id).next().html();
                                        num++;
                                        num=$("#"+selector_id).next().html(num);
                                    }
                                }else{
                                    //for dislike
                                    console.log(id+' '+value+' '+data+' '+selector_id+' ');
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
                                        
                                        }
                                        num=$("#"+selector_id).next().html();
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

                function forum_report(data){
                    $.ajax({
                        method:'POST',
                        url:"{{url('/forum_report')}}",
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

                
                function forum_del_report(id_selector,id){
                    $.ajax({
                        method:'POST',
                        url:"{{url('/forum_del_report')}}",
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
                        url:"{{url('/check_auth')}}",
                        
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
        </script>
        <script type="text/javascript" charset="utf-8">
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
                        url:"{{url('/thread_like_dislike')}}",
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
                        url:"{{url('/thread_report')}}",
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
                        url:"{{url('/comment_like_dislike')}}",
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
                        url:"{{url('/del_report')}}",
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
                        url:"{{url('/check_auth')}}",
                        
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
        </script>
        <!-- /Ajax Script -->
        
        <script type="text/javascript">
            $(document).ready(function(){
                $('.share_via_email').click(function(){
                    $("#mail_model").modal();
                });

                $('#myBtn').click(function(){
                    $('#change_password_user').modal();
                });

                $('#my_editBtn,#check').click(function(){
                    $('#edit_user').modal();
                });

                $('#change_dp').click(function(){
                    $('#change_dp_model').modal();
                });

                $('#scroll_to_reply').click(function(){
                    $('html,body').animate({
                        scrollTop: $('.reply_form').offset().top
                    }, 1000);
                    return false;
                });

                /*$('#review_login_link').click(function(){
                    edit_user();
                 });*/
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function(){
                $(".clickable-row").click(function() {
                    window.location = $(this).attr("href");
                });

                $(".delete_user_bookmark").hover(function(){
                    $(".delete_user_bookmark i").css('font-size','25px');
                    $(".delete_user_bookmark i").attr('class','fa fa-trash delete_user_bookmark');
                },function(){
                    $(".delete_user_bookmark i").css('font-size','20px');
                    $(".delete_user_bookmark i").attr('class','fa fa-trash-o delete_user_bookmark');
                });

                $('.delete_user_bookmark').click(function(){
                    // alert('asddf');
                    var b_id=$(".delete_user_bookmark i").attr('id');

                    $.ajax({
                        url:"{{url('bookmark_school_delete')}}",
                        method:"POST",
                        data:{'bookmark_id':b_id},

                        success:function(response){
                            if(response == 404){
                                console.log('not deleted');
                            }else{
                                $('#row_'+b_id).remove();
                            }
                        },
                        error:function(response){
                            console.log("error in deleting user school bookmark");
                        }
                    });
                });

            });
        </script>
    </body>
</html>