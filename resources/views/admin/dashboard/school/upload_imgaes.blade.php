<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <h2 class="page-header">{{ $schools->school_name }}School Profile</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href=" {{ route('school.index')}} ">Manage schools </a> </li>
                <li class="breadcrumb-item active">upload </li>
            </ol>
        </div>