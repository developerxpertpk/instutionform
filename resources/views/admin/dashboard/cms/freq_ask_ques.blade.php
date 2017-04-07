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
                                <td>{{ $question->question }}</td>
                                <td>{{ $question->answer }}</td>
                                <td>
                                    <a href="#" type="btn btn-primery">Edit </a>
                                    <a href="#" type="btn btn-danger">Delete </a>

                                </td>
                            </tr>
                        @endforeach
                    </table>
        </div>
    </div>

@endsection
