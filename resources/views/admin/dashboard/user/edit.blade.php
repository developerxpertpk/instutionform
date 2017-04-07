
@extends('layouts.admin.adminLayout')
@section('content')

       <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>BLOCK USER</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('user.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>Title
        </div>
    @endif

    <div class="row">
      {{ Form::open(['route' =>['user.update1',$user->id],'method'=>'POST','class'=>'',])}}
  
       {{ Form::label('status') }}

       @if($user->status == 1)
        {{ Form::radio('status', '0', true, ['class' => 'name','value' => 0])}} Unblock
        

        @else($user->status == 0)
          {{ Form::radio('status', '1', true, ['class' => 'name','value' => 1]) }} block
        @endif

    <button type="submit" class="btn btn-primary" name="submit"> Submit  </button>                             
    {!! Form::close() !!}

        </div>

    <div>
    
</div>

 
@endsection

