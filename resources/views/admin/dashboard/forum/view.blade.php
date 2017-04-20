@extends('layouts.admin.adminLayout')
@section('content')

    <div id="page-wrapper">

        <div class="container-fluid">
        <!-- Page Heading -->
             <div class="row">

                 <div class="col-lg-12">

                     <h3 class="page-header">
                         {{$show_data->schools->school_name }} Forum View
                     </h3>
                 </div>
             </div>

        <div class="pull-right">
            <a href="{{ route('forum.index')}}"> <button class="btn btn-primery">Back
                </button></a>
        </div>
        <!-- Message -->
        <div class="message">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{  $message }}</p>
                </div>
            @endif
        </div>
            <!--/.Message -->

            <div class="view">

                <div id="show-rounder">

                    <h3> Title </h3>
                           <div class="forum-title ">
                                <h3>{{ $show_data->title }}</h3>
                           </div>

                    <h3> Description </h3>
                            <div class="forum-description">
                                <h3>{{ $show_data->description }}</h3>
                            </div>
                </div>


            </div>

     </div>
 </div>

@endsection