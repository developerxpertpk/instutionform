@extends('layouts.forumfinder_default')
@section('user_content')
    <div class="row1">
        <div class="container-fluid padding_btm_lr">
            <div class="form-horizontal_row2">
            @if(Session::has('error_auth'))
                <span class="help-block">
                    <strong>{{ Session::get('error_auth') }}</strong>
                </span>
            @endif
            @if(isset($redirect) && isset($_GET['title']))
                <form class="form-horizontal" role="form" method="POST" action="{{url('/submit?redirect='.$redirect.'&title='.$_GET['title'].'&description='.$_GET['description'].'&id='.$_GET['id']) }}" >
            @elseif(isset($redirect) && isset($_GET['t_title']))
                <form class="form-horizontal" role="form" method="POST" action="{{url('/submit?redirect='.$redirect.'&t_title='.$_GET['t_title'].'&t_description='.$_GET['t_description'].'&id='.$_GET['id'])  }}" >
            @else
                <form class="form-horizontal" role="form" method="POST" action="{{route('login.submit') }}" >
            @endif
                    <h4 class="login">Login</h4>
                    {{ csrf_field() }}
                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-sm-4 control-label">Email</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-sm-4 control-label">Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required autofocus>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Remember me
                                </label>
                            </div>
                        </div>
                    </div> -->
                    
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            <button type="submit" class="btn btn-success btn-lg">Sign in</button>
                            <a href="{{route('password.request')}}">Forget Password</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>




<!-- 

<br/>
<div class="container">
    <div class="row">
        <div class="col-md-5 col-md-offset-4">
            <div class="panel panel-default animated bounce">
                <div class="panel-heading"> User Login </div>
                <div class="panel-body">
                @if(isset($redirect) && isset($_GET['title']))
                    
                    <form class="form-horizontal" role="form" method="POST" action="{{'/submit?redirect='.$redirect.'&title='.$_GET['title'].'&description='.$_GET['description'].'&id='.$_GET['id'] }}" >
                @elseif(isset($redirect) && isset($_GET['t_title']))
                    
                    <form class="form-horizontal" role="form" method="POST" action="{{ '/submit?redirect='.$redirect.'&t_title='.$_GET['t_title'].'&t_description='.$_GET['t_description'].'&id='.$_GET['id']  }}" >
                @else
                    
                    <form class="form-horizontal" role="form" method="POST" action="{{route('login.submit') }}" >
                @endif
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autofocus>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary custom-btn">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Password ?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        jQuery( document ).ready(function() {
    jQuery('button.custom-btn')(  
   jQuery(this).addClass('animated bounce');
    );
});
    </script>
</div> -->
@endsection
