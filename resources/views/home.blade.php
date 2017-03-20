@extends('layouts.app');
@section('content')
  <h2> Home Page
  <div class="container">
   Name:   {{  Auth::user()->fname }} <br>
   lname:   {{  Auth::user()->lname }}
    </h2>
    </div>
    @endsection
