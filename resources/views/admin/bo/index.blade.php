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
                <a class="btn btn-sm btn-primary" href="{{ route('openbo.form') }}">
                    Open BO Account
                </a>
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
                        <th>Client Image</th>
                        <th>Client Name</th>
                        <th>Client Email</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($boForms as $form)
                        <tr class="list-item">
                            <td>{{ $form->id }}</td>
                            <td>
                                <img style="width: 50px;height:50px;border-radius:50%;" src="{{ asset('user_photo/'.$form->user_photo) }}" alt="">
                            </td>
                            <td>
                                {{ $form->firstname . ' ' . $form->lastname }}
                            </td>
                            <td>
                                {{ $form->email }}
                            </td>
                            <td>
                                {{ $form->address_line_1 }}
                            </td>
                            <td>
                                <a href="{{ route('show.form', ['id' => $form->id]) }}" class="btn btn-sm btn-primary">
                                    View
                                </a>
                                <a href="{{ route('show.test', ['id' => $form->id]) }}" class="btn btn-sm btn-primary">
                                    Test
                                </a>
                                <button type="button" class="btn btn-sm btn-danger deleteBtn" data-id="{{ $form->id }}">
                                    Delete
                                </button>
                                <a href="{{ route('get.form', ['id' => $form->id]) }}" class="btn btn-sm btn-warning">
                                    Download
                                </a>
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
                    <th>Engine version</th>
                    <th>CSS grade</th>
                    </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('admin/assets/js/form.js') }}"></script>

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
