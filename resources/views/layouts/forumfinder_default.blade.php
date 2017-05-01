<!DOCTYPE html><!--Final Design-->
<html>
    <head>
        <title>School Finder</title>


        <script src="{{asset('js/app.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/ckeditor/ckeditor.js')}}" type="text/javascript"></script>

        <!-- Ajax Script -->
        <script src="{{asset('js/ajax_functioning.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/forum_like_dislike.js')}}" type="text/javascript" charset="utf-8" ></script>
        <script src="{{asset('js/thread_like_dislike.js')}}" type="text/javascript" charset="utf-8"></script>
        <!-- /Ajax Script -->

        
        
        
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" href="{{asset('css/forum.css')}}">
        <link rel="stylesheet" href="{{ asset('css/custom_project.css')}}">
        <link rel="stylesheet" href="{{ asset('css/custom.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/coding.css') }}">
        <!-- close -->

        <!-- twitter -->
        <!-- <link rel="me" href="{{ Request::url() }}"> -->
        <!-- twitter -->
        <link rel="shortcut icon" href="/css/style.css">

        <!-- CSRF Tokken for ajax -->
        <meta name="_token" content="{{ csrf_token() }}">
        <!-- /CSRF Tokken for ajax -->
        <style>
        /* Always set the map height explicitly to define the size of the div
        * element that contains the map. */
        /*#map {*/
            /*height: 100%;*/
            /*display: none;*/

        /*}*/
        /* Optional: Makes the sample page fill the window. */
        /*html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }*/
        /*.map_div{*/
            /*display: none;*/
            /*width:500px;
            height:600px;
            margin-left: 100px;
            margin-top: 30px;
            border:2px solid #000;*/
        /*}*/

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
        

        <script>
            window.fbAsyncInit = function() {
                FB.init({
                    appId      : '201788563656236',
                    xfbml      : true,
                    version    : 'v2.8'
                });
                FB.AppEvents.logPageView();
            };
        </script>
        <div id="fb-root"></div>
        <script>
            (function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>


        <script>
            window.twttr = (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0],
                t = window.twttr || {};
                if (d.getElementById(id)) return t;
                js = d.createElement(s);
                js.id = id;
                js.src = "https://platform.twitter.com/widgets.js";
                fjs.parentNode.insertBefore(js, fjs);

                t._e = [];
                t.ready = function(f) {
                t._e.push(f);
                };

              return t;
            }
            (document, "script", "twitter-wjs"));
        </script>
        <header>
            <div class="container-fluid navigation">
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
                            <a class="navbar-brand" href="/"><img src="{{asset('image\finallogo.png')}}"></a>
                        </div>
                        <div id="navbar" class="navbar-collapse collapse">
                            <ul class="nav navbar-nav">                                   

                                <li><a href="/schools_list">List of Schools</a></li>

                                @if(isset($page))
                                    @foreach($page as $pages)
                                        <li><a href="/{{$pages->slug}}">{{$pages->title}}</a></li>
                                    @endforeach
                               @endif

                               <li><a href="/FAQ">FAQ</a></li>
                               <li><a href="/forum">Forum</a></li>
                            </ul>

                            <ul class="nav navbar-nav navbar-right">
                                @if(Route::has('login'))
                                    @if (Auth::check())
                                        
                                        <li class="">
                                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <img src="{{ asset('upload/'.Auth::user()->image) }}" alt="">{{Auth::user()->fname." ".Auth::user()->lname}}
                                                <span class=" fa fa-angle-down"></span>
                                            </a>
                                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                                <li><a href="/home/my_profile"> Profile</a></li>
                                                <li>
                                                    <a href="/bookmarks">
                                                        <!-- <span class="badge bg-red pull-right">50%</span> -->
                                                        <span><i class="fa fa-star pull-right" aria-hidden="true"></i>Bookmarks</span>
                                                    </a>
                                                </li>
                                                <li><a href="javascript:;">Help</a></li>
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
                                        <li><a href="{{ url('/login') }}">Login</a></li>
                                        <li><a href="{{ url('/register') }}">Register</a></li>
                                    @endif
                                @endif
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>

        </header>

        @yield('user_content')

        <!--Footer Portion-->
        <footer id="footer" class="dark">
            <div class="primary-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="col-md-12 col-sm-12">
                                <div class="head5">About Us</div>
                                <ul class="f-list">
                                    <span>Passionate about simplifying schooling decisions, Sqoolz.com offers students, parents and schools an extensive online ecosystem. 
                                    Admission seekers can discover the best schools in the neighbourhood and refine search results based on board, location, facilities, language and gender.
                                    </span>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="col-md-12 col-sm-12">
                                <div class="col-md-4 col-sm-4">
                                    <div class="head5">For Schools</div>
                                    <ul class="f-lists">
                                        <li>
                                            <a href="/addSchool" target="_blank">
                                                <h3>Add Your School</h3>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="mailto:sales@sqoolz.com">
                                                <h3>Claim Your Listing</h3>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://connect.schoolfinder.co.in/" target="_blank">
                                                <h3>Parent Connect</h3>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://acquire.sqoolz.com/login" target="_blank">
                                                <h3>Student Acquisition</h3>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="head5">Help</div>
                                    <ul class="f-lists">
                                        <li>
                                            <a href="mailto:info@sqoolz.com">
                                                <h3>Contact Us</h3>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/directory" target="_blank">
                                                <h3>Sitemap</h3>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="mailto:info@sqoolz.com">
                                                <h3>Facebook</h3>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="mailto:info@sqoolz.com">
                                                <h3>Twitter</h3>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="pull-left">
                                                <div class="social-link circle a data-toggle="tooltip" data-placement="auto" data-original-title="Facebook" class="facebook" href="/externalLink?link=https://www.facebook.com/sqoolz" target="_blank">
                                                    <i class="fa fa-facebook"></i></a>
                                                    <a data-toggle="tooltip" data-placement="auto" data-original-title="Twitter" class="twitter" href="/externalLink?link=https://twitter.com/sqoolzhq" target="_blank">
                                                        <i class="fa fa-twitter"></i>
                                                    </a>
                                                    <a data-toggle="tooltip" data-placement="auto" data-original-title="Google Plus" class="google" href="/externalLink?link=https://plus.google.com/%2BSqoolz" target="_blank">
                                                        <i class="fa fa-google-plus"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="head5">Terms</div>
                                    <ul class="f-lists">
                                        <li>
                                            <a href="/termsofuse">
                                                <h3>Terms Of Use</h3>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/privacypolicy">
                                                <h3>Privacy Policy</h3>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.sqoolz.com/what-we-do/" target="_blank">
                                                <h3>What We Do</h3>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="primary-footer botom_f">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                            <div class="col-md-3 col-sm-3 col-lg-3 col-xs-12">
                                <ul class="f-list">
                                    <li>
                                        <a href="/schools/Pune" target="_blank">
                                            <h3>Best schools in Pune</h3>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/schools/Mumbai" target="_blank">
                                            <h3>Best schools in Mumbai</h3>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/schools/Delhi" target="_blank">
                                            <h3>Best schools in Delhi</h3>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/schools/Bangalore" target="_blank">
                                            <h3>Best schools in Bangalore</h3>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-3 col-sm-3 col-lg-3 col-xs-12">
                                <ul class="f-list">
                                    <li>
                                        <a href="/schools/Chennai" target="_blank">
                                            <h3>Best schools in Chennai</h3>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/schools/Hyderabad" target="_blank">
                                            <h3>Best schools in Hyderabad</h3>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/schools/Kolkata" target="_blank">
                                            <h3>Best schools in Kolkata</h3>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/schools/Ahmedabad" target="_blank">
                                            <h3>Best schools in Ahmedabad</h3>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-3 col-sm-3 col-lg-3 col-xs-12">
                                <ul class="f-list">
                                    <li>
                                        <a href="/schools/Coimbatore" target="_blank">
                                            <h3>Best schools in Coimbatore</h3>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/schools/Indore" target="_blank">
                                            <h3>Best schools in Indore</h3>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/schools/Darjeeling" target="_blank">
                                            <h3>Best schools in Darjeeling</h3>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/schools/Dehradun" target="_blank">
                                            <h3>Best schools in Dehradun</h3>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-3 col-sm-3 col-lg-3 col-xs-12">
                                <ul class="f-list">
                                    <li>
                                        <a href="/schools/Panchgani" target="_blank">
                                            <h3>Best schools in Panchgani</h3>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="secondary-footer">
                <div class="container">
                    <div>
                        <div class="col-md-12 text-color pull-left">
                            <span>© 2017 By 
                                <a href="http://www.wishtreetech.com" target="_blank" class="text-color">Talentelgia Technologies LLP.</a> All Rights Reserved </span>
                        </div>
                    </div>
                </div>
            </div>
                
        </footer>
        <script type="text/javascript">
             CKEDITOR.replace('review_area');

             $('#review_login_link').click(function(){
                edit_user();
             });
        </script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('.share_via_email').click(function(){
                    $("#mail_model").modal();
                });

                $('#myBtn').click(function(){
                    $('#change_password_user').modal();
                });

                $('#my_editBtn').click(function(){
                    $('#edit_user').modal();
                });
            });
        </script>

        <script>
            // create social networking pop-ups
            (function() {
                // link selector and pop-up window size
                var Config = {
                    Link: "a.share",
                    Width: 500,
                    Height: 500
                };

                // add handler links
                var slink = document.querySelectorAll(Config.Link);
                for (var a = 0; a < slink.length; a++) {
                    slink[a].onclick = PopupHandler;
                }

                // create popup
                function PopupHandler(e) {

                    e = (e ? e : window.event);
                    var t = (e.target ? e.target : e.srcElement);

                    // popup position
                    var
                        px = Math.floor(((screen.availWidth || 1024) - Config.Width) / 2),
                        py = Math.floor(((screen.availHeight || 700) - Config.Height) / 2);

                    // open popup
                    var popup = window.open(t.href, "social", 
                        "width="+Config.Width+",height="+Config.Height+
                        ",left="+px+",top="+py+
                        ",location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1");
                    if (popup) {
                        popup.focus();
                        if (e.preventDefault) e.preventDefault();
                        e.returnValue = false;
                    }

                    return !!popup;
                }

            }());
        </script>
        <script type="text/javascript">
            $(document).ready(function(){
                $(".clickable-row").click(function() {
                    window.location = $(this).attr("href");
                });
            });
        </script>
    </body>
</html>