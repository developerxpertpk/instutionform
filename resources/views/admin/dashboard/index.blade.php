@extends('layouts.admin.adminLayout')
@section('content')
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <i class="fa fa-dashboard"> Dashboard</i>
                        </h1>

                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i>
                            </li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">

                                <div class="row">

                                    <div class="col-xs-3">
                                        <i class="fa fa-users fa-5x" aria-hidden="true" > </i>
                                    </div>

                                    <div class="col-xs-9 text-right">
                                        <div class="huge"> {{ $users }}</div>
                                        <div>Total User!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('user.index') }}">
                                <div class="panel-footer">
                                    <span class="pull-left">User List</span>
                                    <span class="pull-right">
                                    <i class="fa fa-user"></i>
                                    </span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-graduation-cap fa-5x" aria-hidden="true"> </i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"> {{ $schools }}</div>
                                        <div>Total School</div>
                                    </div>
                                </div>
                            </div>
                            <a href=" {{ route('school.index') }}">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-newspaper-o fa-5x" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"> {{ $news }}</div>
                                        <div> News </div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('school_news.index') }}">
                                <div class="panel-footer">
                                    <span class="pull-left">View News</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-star fa-5x" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"> {{ $ratings }}</div>
                                        <div>Rating</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{route('rating_reviews.index')}}">
                                <div class="panel-footer">
                                    <span class="pull-left">View Rating & reviews</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments-o fa-5x" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">  {{ $forums }}</div>
                                        <div> Forum </div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{route('forum.index')}}">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file fa-5x" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">  {{ $pages }}</div>
                                        <div>Static pages</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{route('content.index')}}">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">  {{ $faq }}</div>
                                        <div>FAQ's</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{route('freq_ask_ques')}}">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
        </div>
            <!-- /.container-fluid -->
@endsection

