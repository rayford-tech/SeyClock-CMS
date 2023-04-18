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
            <h3 class="page-title">Configurations</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">configs</li>
            </ul>
        </div>
    </div>
</div>

@endsection

@section('content')
<form method="POST" action="{{route('backend.configs')}}" enctype="multipart/form-data">

    <div class="row">
        @csrf
        <div class="col-sm-4">
            <div class="form-group">
                <label class="col-form-label">Longitude <span class="text-danger">*</span></label>
                <input required class="form-control" value="{{$config->longitude ?? ''}}" type="text" name="longitude" />
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="col-form-label">Latitude <span class="text-danger">*</span></label>
                <input required class="form-control" value="{{$config->latitude ?? ''}}" type="text" name="latitude" />
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="col-form-label">Required distance (KM) <span class="text-danger">*</span></label>
                <input required class="form-control" value="{{$config->required_km ?? ''}}" type="number" step="0.01" name="required_km" />
            </div>
        </div>


    </div>
    <div class="submit-section">
        <button class="btn btn-primary submit-btn">Submit</button>
    </div>
</form>
@endsection
