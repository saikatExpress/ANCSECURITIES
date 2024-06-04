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
                    Add Designation
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
              <h3 class="box-title">Designation List</h3>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Created By</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($designations as $designation)
                        <tr class="list-item">
                            <td>{{ $designation->id }}</td>

                            <td>
                                {{ $designation->name }}
                            </td>
                            <td>
                                {{ ($designation->created_by) ?? 'ANC ADMIN' }}
                            </td>
                            <td>
                                {{ $designation->created_at->format('d-M-Y') }}
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary editBtn" data-id="{{ $designation->id }}"
                                data-name="{{ $designation->name }}" data-description="{{ $designation->description }}"
                                data-status="{{ $designation->status }}"
                                data-toggle="modal" data-target="#editModal">
                                    Edit
                                </button>
                                <button type="button" class="btn btn-sm btn-danger deleteBtn" data-id="{{ $designation->id }}">
                                    Delete
                                </button>
                            </td>
                        </tr>
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
                    <h4 class="modal-title">Add Designation</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('designation.store') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" class="form-control"></textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Save Designation</button>
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
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Designation</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('designation.update') }}" method="post" id="designationForm">
                        @csrf
                        <input type="hidden" name="designationId" id="designationId">

                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="dName" id="dName">
                            <span class="text-sm text-danger" id="nameErr"></span>
                            @error('dName')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="dDescription" id="dDescription" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="status" id="status" class="form-control" id="">
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Save changes</button>
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
    <script src="{{ asset('admin/assets/js/designation.js') }}"></script>

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
