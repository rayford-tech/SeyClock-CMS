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
@endsection
@section('scripts')
<!-- Select2 JS -->
<script src="/assets/js/select2.min.js"></script>

<!-- Datetimepicker JS -->
<script src="/assets/js/moment.min.js"></script>
<script src="/assets/js/bootstrap-datetimepicker.min.js"></script>

<!-- Datatable JS -->
<script src="/assets/js/jquery.dataTables.min.js"></script>
<script src="/assets/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
    function deleteUser(id) {
        if(confirm("Do u want to continue?")) {

        }
    }
</script>
@endsection

@section('heading')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Clockins</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">clockins</li>
            </ul>
        </div>
    </div>
</div>

@endsection

@section('content')

{{--  --}}

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered mb-0" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                            <thead>
                                <tr role="row">
                                    <th class="" tabindex="0"  rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 20px;">Sr. No</th>
                                    <th class="" tabindex="0"  rowspan="1" colspan="1" aria-label="Employee ID: activate to sort column ascending" style="width: 174px;">User</th>
                                    <th class="" tabindex="0"  rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending" style="width: 324px;">Clockin</th>
                                    <th class="" tabindex="0"  rowspan="1" colspan="1" aria-label="Mobile: activate to sort column ascending" style="width: 117px;">Clockout</th>
                                    <th class="text-right no-sort " tabindex="0"  rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 158px;">IP</th>
                                    <th class="text-right no-sort " tabindex="0"  rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 158px;">User Photo</th>
                                    <th class="text-right no-sort " tabindex="0"  rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 158px;">Clockinn Photo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clockins as $key => $clockin)
                                <tr role="row" class="odd">
                                    <td>{{$key + 1}}</td>
                                    <td>{{$clockin->user->name}}</td>
                                    <td>{{\Carbon\Carbon::parse($clockin->clockin)->toDayDateTimeString()}}</td>
                                    <td>{{$clockin->clockout ? \Carbon\Carbon::parse($clockin->clockout)->toDayDateTimeString() : '-'}}</td>
                                    <td>{{$clockin->ip}}</td>
                                    <td>
                                        @if ($clockin->user->profile_photo)
                                        <a href="{{env('DO_URL').'/'.$clockin->user->profile_photo}}" target="blank">View</a>
                                        @else
                                        NA
                                        @endif
                                    </td>
                                    <td>
                                        @if ($clockin->photo)
                                        <a href="{{env('DO_URL').'/'.$clockin->photo}}" target="blank">View</a>
                                        @else
                                        NA
                                        @endif
                                    </td>

                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="row" style="margin-top: 50px;">
                        <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                            {{$clockins->links()}}
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
