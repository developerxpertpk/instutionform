@extends('layouts.user_default')
@section('content_user')
<!-- page content -->
<div class="right_col" role="main">
   <!-- top tiles -->
   <div class="row tile_count">
      
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph">
               <div class="row x_title">
                  <div class="col-md-12">
                     <h3>Dashboard <small>Bookmarked Schools</small></h3>
                     <br />
                  </div>
                  <div class="col-md-12">
                     <table class="table table-hover table-responsive table-striped" style="cursor: pointer;">
                        @foreach($bookmarked_schools as $bookmarked_school)
                           <tr id="row_{{$bookmarked_school->id}}">
                              <td class='clickable-row' href="/show_school/{{$bookmarked_school->schools->id}}" width="40%">{{$bookmarked_school->schools->school_name}}</td>
                              <td class='clickable-row' href="/show_school/{{$bookmarked_school->schools->id}}" width="15%">{{$bookmarked_school->schools['locations']->city }}</td>
                              <td class='clickable-row' href="/show_school/{{$bookmarked_school->schools->id}}" width="15%">{{$bookmarked_school->schools['locations']->state }}</td>
                              <td class='clickable-row' href="/show_school/{{$bookmarked_school->schools->id}}" width="15%">{{$bookmarked_school->schools['locations']->country }}</td>
                              <td width="15%">
                                 <i id="{{$bookmarked_school->id}}" class="fa fa-trash-o delete_user_bookmark" aria-hidden="true"></i>
                              </td>
                           </tr>

                        @endforeach
                     </table>
                     {{$bookmarked_schools->links()}}
                  </div>
                  
               </div>
               <div class="clearfix"></div>
            </div>
         </div>
      </div>
      <br />

</div>
<!-- /page content -->
@endsection