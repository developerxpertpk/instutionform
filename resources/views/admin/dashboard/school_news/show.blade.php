@extends('layouts.admin.adminLayout')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <h1 class="page-header">
                    School News
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item "><a href="{{ route('school_news.index') }}">School News</a></li>
                    <li class="breadcrumb-item active">Show School News </li>
                </ol>
            </div>
            <div class="row conatiner news">
                <h1 class="page-header"> {{ $school_news->schools->school_name }} </h1>
                <div class="news-title">
                    <h4> Title:
                     {{ $school_news->news_title }} </h4>
                </div>
                <div class="news-description">
                    <h5>  {{ $school_news->news_description }} </h5>
                 </div>
        </div>
    </div>
   </div>
@endsection