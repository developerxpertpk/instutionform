<!DOCTYPE html><!--Final Design-->
<html>
    <head>
        <script src="{{asset('js/app.js')}}" type="text/javascript"></script>
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" href="{{ asset('css/custom_project.css')}}">
        <link rel="stylesheet" href="{{ asset('css/custom.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/coding.css') }}">
    </head>
    <body>
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
                            <a class="navbar-brand" href="#"><img src="image\finallogo.png"></a>
                        </div>
                        <div id="navbar" class="navbar-collapse collapse">
                            <ul class="nav navbar-nav">
                                <li><a href="/">Home</a></li>
                                <li><a href="#">About</a></li>
                                <li><a href="#">School Details</a></li>
                                <li><a href="schools_list">List of Schools</a></li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                @if(Route::has('login'))
                                    @if (Auth::check())
                                        <li><a href="{{ url('/home') }}">Home</a></li>
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