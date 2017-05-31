@extends('layouts.forumfinder_default')
@section('user_content')
   <div class="container">
      <div class="col-md-12">
         <h2>List of Bookmarks<small> (Schools)</small></h2>
         <br />
      </div>
      <div class="col-md-12">
      @if(count($bookmarked_schools) )
         <table class="table table-hover table-responsive table-striped" style="cursor: pointer;">
            @foreach($bookmarked_schools as $bookmarked_school)
               <tr id="row_{{$bookmarked_school->id}}">
                  <td class='clickable-row' href="/show_school/{{$bookmarked_school->schools->id}}" width="40%">{{$bookmarked_school->schools->school_name}}</td>
                  <td class='clickable-row' href="/show_school/{{$bookmarked_school->schools->id}}" width="15%">{{$bookmarked_school->schools['locations']->city }}</td>
                  <td class='clickable-row' href="/show_school/{{$bookmarked_school->schools->id}}" width="15%">{{$bookmarked_school->schools['locations']->state }}</td>
                  <td class='clickable-row' href="/show_school/{{$bookmarked_school->schools->id}}" width="15%">{{$bookmarked_school->schools['locations']->country }}</td>
                  <td width="15%" class="delete_user_bookmark">
                     <i id="{{$bookmarked_school->id}}" style="font-size: 20px;" class="fa fa-trash-o" aria-hidden="true"></i>
                  </td>
               </tr>

            @endforeach
         </table>
         {{$bookmarked_schools->links()}}
      @else
      <h1>No Bookmarks Found</h1>
      @endif
      </div>
      <div class="clearfix"></div>
   </div>
            
@endsection