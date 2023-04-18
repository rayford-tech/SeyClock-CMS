@extends('backend.layouts.app')

@section('links')
<!-- Lineawesome CSS -->
<link rel="stylesheet" href="/assets/css/line-awesome.min.css">

<!-- Datatable CSS -->
<link rel="stylesheet" href="/assets/css/dataTables.bootstrap4.min.css">

<!-- Select2 CSS -->
<link rel="stylesheet" href="/assets/css/select2.min.css">

<!-- Datetimepicker CSS -->
<link rel="stylesheet" href="/assets/css/bootstrap-datetimepicker.min.css">
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.css"/> --}}

@endsection
@section('scripts')
<!-- Select2 JS -->
<script src="/assets/js/select2.min.js"></script>

<!-- Datetimepicker JS -->

{{-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> --}}

	{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.min.js"></script> --}}
<script src="/assets/js/bootstrap-datetimepicker.min.js"></script>

<!-- Datatable JS -->
<script src="/assets/js/jquery.dataTables.min.js"></script>
<script src="/assets/js/dataTables.bootstrap4.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.min.js"></script> --}}


@endsection

@section('heading')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Staffs</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Staffs</li>
            </ul>
        </div>
    </div>
</div>

@endsection

@section('content')
<form method="POST" action="{{route('backend.users.edit', [$user->id])}}" enctype="multipart/form-data">

    <div class="row">
        @csrf
        <div class="col-sm-12">
            <div class="form-group">
                <label class="col-form-label">Staff Type <span class="text-danger">*</span></label>
                <select class="form-control" required name="roleid" data-select2-id="4" tabindex="-1" aria-hidden="true">
                    <option value="1" {{$user->roleid == 1 ? 'selected' : ''}}>Admin</option>
                    <option value="2" {{$user->roleid == 2 ? 'selected' : ''}}>Worker</option>
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-form-label">Full Name<span class="text-danger">*</span></label>
                <input class="form-control" value="{{$user->name}}" required name="name" type="text" />
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-form-label">Email <span class="text-danger">*</span></label>
                <input required class="form-control" value="{{$user->email}}" type="email" name="email" />
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label class="col-form-label">Password <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="password" />
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label class="col-form-label">Profile Image <span class="text-danger">*</span></label>
                <input required class="form-control" type="file" name="profile_image" />
            </div>
        </div>


    </div>
    <div class="submit-section">
        <button class="btn btn-primary submit-btn">Submit</button>
    </div>
</form>
@endsection
