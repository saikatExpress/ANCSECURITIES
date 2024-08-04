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
                <a class="btn btn-sm btn-primary" href="{{ route('work.list') }}">Work List</a>
            </p>
        </section>

        <section class="content">
            @if ($errors->any())
                <div class="alert alert-danger errorAlert">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @if(session('message'))
                <div class="alert alert-success" id="successAlert">{{ session('message') }}</div>
            @endif

            @if(session('errors'))
                <div class="alert alert-danger errorAlert">{{ session('errors') }}</div>
            @endif

            <div class="card mt-4 shadow-lg border-0">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Create Work</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('work.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="department_id">Department</label>
                            <select name="department_id" id="department_id" class="form-control" required>
                                <option value="" disabled selected>Select department</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="work-fields-container">
                            <div class="work-fields">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="title">Work Title</label>
                                        <input type="text" name="title[]" class="form-control" placeholder="Enter work title" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="status">Status</label>
                                        <select name="status[]" class="form-control" required>
                                            <option value="" disabled selected>Select status</option>
                                            <option value="Pending">Pending</option>
                                            <option value="In Progress">In Progress</option>
                                            <option value="Completed">Completed</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description[]" class="form-control" rows="4" placeholder="Enter work description" required></textarea>
                                </div>

                                <hr class="my-4">
                            </div>
                        </div>

                        <button type="button" class="btn btn-success" id="add-more-work">Add More</button>
                        <hr>
                        <button type="submit" class="btn btn-success btn-block mt-4">Create Work</button>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <style>
        .form-control:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        .card {
            background-color: #f8f9fa;
            border-radius: 10px;
        }
        .card-header {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        $(document).ready(function() {
            // Show the alert message
            $('.errorAlert').show();

            // Hide the alert message after 3 seconds
            setTimeout(function() {
                $('.errorAlert').fadeOut('slow');
            }, 3000);
        });
    </script>

    <script>
        document.getElementById('add-more-work').addEventListener('click', function() {
            const workFieldsContainer = document.getElementById('work-fields-container');
            const workFields = document.querySelector('.work-fields').cloneNode(true);
            const inputs = workFields.querySelectorAll('input, textarea, select');

            inputs.forEach(input => {
                input.value = '';
                input.classList.remove('is-invalid');
            });

            workFieldsContainer.appendChild(workFields);
        });
    </script>
@endsection
