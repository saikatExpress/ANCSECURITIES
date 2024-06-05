@extends('admin.layout.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Dashboard
                <strong class="text-sm text-success fw-bold">Admin</strong>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">{{ $pageTitle }}</li>
            </ol>
            <p style="text-align: right;">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-default">
                    Add Leave
                </button>
            </p>
        </section>

        <section class="content">

            @if(session('message'))
                <div class="alert alert-success" id="successAlert">
                    {{ session('message') }}
                </div>
            @endif

            <div class="box">
            <div class="box-header">
              <h3 class="box-title">Form List</h3>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>No of Leaves</th>
                        <th>Created By</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sl = 1;
                    @endphp
                    @foreach ($leaves as $leave)
                        <tr class="list-item">
                            <td>{{ $sl }}</td>
                            <td>
                                {{ $leave->leave_type }}
                            </td>
                            <td>
                                {{ $leave->number_of_leave }}
                            </td>
                            <td>
                                {{ ($leave->created_by) ?? 'ANC ADMIN' }}
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary editBtn"
                                    data-id="{{ $leave->id }}" data-name="{{ $leave->leave_type }}"
                                    data-number_of_leave="{{ $leave->number_of_leave }}"
                                    data-toggle="modal" data-target="#editModal">
                                    Edit
                                </button>
                                <button type="button" class="btn btn-sm btn-danger deleteBtn" data-id="{{ $leave->id }}">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        @php
                            $sl++;
                        @endphp
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                    <th>Engine version</th>
                    <th>CSS grade</th>
                    </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </section>
    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Add Leave Type</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('leave.store') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" class="form-control" name="leave_type" placeholder="Leave type..">
                            @error('leave_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Number of leave</label>
                            <input type="number" class="form-control" name="number_of_leave">
                            @error('number_of_leave')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Add Leave</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Update Leave Type</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('leave.update') }}" method="post">
                        @csrf
                        <input type="hidden" name="leaveId" id="leaveId">
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" class="form-control" id="ltype" name="leave_type" placeholder="Leave type..">
                            @error('leave_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Number of leave</label>
                            <input type="text" class="form-control" id="noOfleav" name="number_of_leave">
                            @error('number_of_leave')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update Leave</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('admin/assets/js/leave.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Show the alert message
            $('#successAlert').show();

            // Hide the alert message after 3 seconds
            setTimeout(function() {
                $('#successAlert').fadeOut('slow');
            }, 3000);
        });
    </script>
@endsection
