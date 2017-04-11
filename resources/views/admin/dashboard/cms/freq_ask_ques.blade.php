@extends('layouts.admin.adminLayout')

@section('content')
    <div class="page-wraper">
            <div class="conatiner-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header">
                            Frequently Asked Question
                        </h2>
                        <div class="pull-right">
                            <a class="btn btn-success" href="{{ route('add_question')}}">Add Question </a>
                            <a class="btn btn-danger" href="{{ route('admin.dashboard') }}"> BACK  </a>
                        </div>

                    </div>
                </div>

                @if (count($errors))
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                        @foreach ($errors->all() as $error)
                            <!--   <li>{{ $error }}</li> -->
                                <?php echo $errors ;?>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{  $message }}</p>
                    </div>
                @endif

                <div class="Qusetion-list">
                    <table class="table table-bordered">
                        <tr>
                            <h3>FAQ's </h3>
                        </tr>

                        <tr>
                            <th>ID</th>
                            <th>Question</th>
                            <th>Answer</th>
                            <th width="320px">Action</th>
                        </tr>
                        @foreach ($ques as $question)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td><p class="faq_question">{{ $question->question }}</p></td>
                                <td><p class="faq_answer">{{ $question->answer }}</p></td>
                                <td>
                                    <a href="#" type="btn btn-primery">Edit </a>

            <!-- Button for  Delete-->
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal01">
                Delete
            </button>
                                    <!-- Modal  for delete with id=01-->
            <div class="modal fade" id="myModal01" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Confirmation  </h4>
                        </div>

                        <div class="modal-body">
                            <h3> Do you want to delete {{$question->question}} ? </h3>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
                            {!! Form::open(['method' => 'DELETE','route' => ['quest_destroy',$question->id],'style'=>'display:inline','class'=>'delete']) !!}
                            {!! Form::submit('delete', ['class' => 'btn btn-success']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>

    </td>
    </tr>
    @endforeach
    </table>
        </div>
    </div>

@endsection
