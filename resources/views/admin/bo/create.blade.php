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
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createModal">
                    Add BO
                </button>
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal">
                    File Upload
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
              <h3 class="box-title">BO List</h3>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>BO ID</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bos as $form)
                        <tr class="list-item">
                            <td>{{ $form->id }}</td>
                            <td>
                                {{ str_pad($form->bo_id, 4,0, STR_PAD_LEFT) }}
                            </td>
                            <td>
                                {{ $form->name }}
                            </td>

                            <td>
                                <button type="button" class="btn btn-sm btn-primary">
                                    Edit
                                </button>
                                <button type="button" class="btn btn-sm btn-danger deleteBtn" data-id="{{ $form->id }}">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </section>
    </div>

    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Create Bo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('acbo.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">BO ID : <span class="text-danger"> * </span></label>
                        <input type="text" class="form-control" name="boId" id="boId">
                    </div>
                    <div class="form-group">
                        <label for="">Name : </label>
                        <input type="text" class="form-control" name="client_name" id="client_name">
                    </div>
                    <div class="form-group">
                        <label for="">Account type : </label>
                        <select name="ac_type" id="ac_type" class="form-control">
                            <option value="" selected disabled>Select</option>
                            <option value="indivijual">Individual Account</option>
                            <option value="joint">Joint Account</option>
                        </select>
                    </div>

                    <input type="submit" class="btn btn-sm btn-primary" value="Save BO">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">File Upload</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="uploadForm" method="post" action="{{ route('upload.excel') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">File Upload : <span class="text-danger"> * </span></label>
                        <input type="file" name="bo_file" id="bo_file" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary" id="saveChanges">Upload File</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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

    <script>

    </script>

@endsection
