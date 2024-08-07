@extends('admin.layout.app')
    <style>
        .card {
            margin: 20px;
        }
        .form-check {
            margin-bottom: 10px;
        }
        .form-check-label {
            margin-left: 10px;
        }
        #items {
            display: flex;
            flex-wrap: wrap;
            gap: 15px; /* Space between items */
        }
        .form-check {
            flex: 1 1 calc(33.333% - 15px); /* Adjust to fit 3 items per row */
            box-sizing: border-box;
        }
        .form-check-input {
            margin-right: 10px; /* Space between checkbox and label */
        }
    </style>
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
                <a href="{{ route('assign.portfolio_list') }}" class="btn btn-sm btn-primary">
                    Assign Portofolio List
                </a>
            </p>
        </section>

        <section class="content">
            @if(session('message'))
                <div class="alert alert-success" id="successAlert">
                    {{ session('message') }}
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Assign Portfolio</h5>

                    <form action="{{ route('store.portfolio') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Employee</label>
                            <select name="employee_id" id="employee_id" class="form-control">
                                <option value="" selected disabled>Select</option>
                                @foreach ($employees as $employe)
                                    <option value="{{ $employe->id }}">{{ $employe->name }}</option>
                                @endforeach
                            </select>
                        </div>

                         <div class="form-group">
                            <label for="items">Select Items</label>
                            <div id="items">
                                @foreach ($bos as $item)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="selected_items[]" value="{{ $item->id }}" id="item{{ $item->id }}">
                                        <label class="form-check-label" for="item{{ $item->id }}">
                                            {{ $item->name }} (BO ID: {{ $item->bo_id }})
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Assign & Commit</button>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
