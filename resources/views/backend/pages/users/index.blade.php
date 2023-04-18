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
            var route = "{{ route('backend.admin.api.delete.user') }}";
            var url = `${route}/${id}`
            window.location.href = url
        }
    }
</script>
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
        <div class="col-auto float-right ml-auto">
            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Add Staff</a>

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
                                    <th class="" tabindex="0"  rowspan="1" colspan="1" aria-label="Employee ID: activate to sort column ascending" style="width: 174px;">Staff Type</th>
                                    <th class="" tabindex="0"  rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending" style="width: 324px;">Full Name</th>
                                    <th class="" tabindex="0"  rowspan="1" colspan="1" aria-label="Mobile: activate to sort column ascending" style="width: 117px;">Email</th>
                                    <th class="text-right no-sort " tabindex="0"  rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 158px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                <tr role="row" class="odd">
                                    <td>{{$key + 1}}</td>
                                    <td>
                                        {{$user->roleid == 1 ? 'Admin' : 'Worker'}}
                                    </td>
                                    <td class="sorting_1">
                                        <h2 class="table-avatar">
                                            <a href="#">{{$user->name}}</a>
                                        </h2>
                                    </td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        <a class="tb-link" href="{{route('backend.users.edit', [$user->id])}}"><i class="fa fa-pencil m-r-5"></i> Edit</a> |
                                        <a class="tb-link" href="" onclick="event.preventDefault();deleteUser('{!! $user->id !!}');"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                    </td>


                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="row" style="margin-top: 50px;">
                        <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                            {{$users->links()}}
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


{{-- Modals --}}
<div id="add_employee" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Staff</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('backend.users')}}" enctype="multipart/form-data">

                    <div class="row">
                        @csrf
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label">Staff Type <span class="text-danger">*</span></label>
                                <select class="form-control" required name="roleid" data-select2-id="4" tabindex="-1" aria-hidden="true">
                                    <option value="1">Admin</option>
                                    <option value="2">Worker</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Full Name<span class="text-danger">*</span></label>
                                <input class="form-control" required name="name" type="text" />
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                <input required class="form-control" type="email" name="email" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label">Password <span class="text-danger">*</span></label>
                                <input required class="form-control" type="text" name="password" />
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
            </div>
        </div>
    </div>
</div>

@endsection
