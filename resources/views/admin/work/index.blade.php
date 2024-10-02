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
                <a class="btn btn-sm btn-primary" href="{{ route('add.work') }}">
                    Add Work
                </a>
            </p>
        </section>

        <section class="content">

            @if(session('message'))
                <div class="alert alert-success" id="successAlert">
                    {{ session('message') }}
                </div>
            @endif

            @if(session('errors'))
                <div class="alert alert-danger errorAlert">
                    {{ session('errors') }}
                </div>
            @endif

            <div class="box">
                <div class="box-header">
                <h3 class="box-title">Work List</h3>
                </div>
                <div class="box-body">
                    @foreach ($worksByDepartment as $departmentId => $works)
                        @php
                            $department = $works->first()->department;
                        @endphp
                        <div class="card mt-4">
                            <div class="card-header bg-primary text-white">
                                <h3 class="card-title">{{ $department->name }}</h3>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    @foreach ($works as $work)
                                        <li class="list-group-item" style="margin-bottom: 8px;">
                                            <h5>{{ $work->work_title }}</h5>
                                            <p>{{ $work->description }}</p>
                                            <span class="badge badge-{{ $work->status == 'Completed' ? 'success' : ($work->status == 'In Progress' ? 'warning' : 'secondary') }}">
                                                {{ $work->status }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
          </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('admin/assets/js/form.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#successAlert').show();

            setTimeout(function() {
                $('#successAlert').fadeOut('slow');
            }, 3000);
        });
    </script>
@endsection
