
@extends('layouts.forumfinder_default')
@section('content')

    @foreach($page as $page_data)
            <table>
                <tr>
                    <td>  {{ $page_data->id }}</td>
                </tr>
            </table>

    @endforeach
@endsection