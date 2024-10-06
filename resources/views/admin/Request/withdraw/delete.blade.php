@extends('admin.layout.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <x-sub-header/>
            <h1>
                Dashboard
                <strong class="text-sm text-success fw-bold" style="text-transform: uppercase;">{{ auth()->user()->role }}</strong>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">{{ $pageTitle }}</li>
            </ol>
            <p style="text-align: right;">
                <a class="btn btn-sm btn-primary" href="{{ route('admin.withdrawlist') }}">Withdraw Request List</a>
            </p>
        </section>

        <section class="content">
            @if(session('message'))
                <div class="alert alert-success" id="successAlert">{{ session('message') }}</div>
            @endif

            @if(session('errors'))
                <div class="alert alert-danger errorAlert">{{ session('errors') }}</div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <h4>Withdraw Request List</h4>
                        <a href="{{ route('withdrawdeletedrequest') }}" class="btn btn-sm btn-danger">
                            Show Deleted Request
                        </a>
                    </div>
                    <div style="width: 100%;box-shadow: 0 0 10px rgba(0,0,0,0.1);border-radius: 4px;background-color: #fff;">
                        <table class="styled-table" id="">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Trading Code</th>
                                    <th>Amount</th>
                                    <th>AC No</th>
                                    <th>Category</th>
                                    <th>Withdraw Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deletedRequest as $request)
                                    <tr>
                                        <td>{{ $request->id }}</td>
                                        <td>{{ $request->clients->name }}</td>
                                        <td>{{ $request->clients->trading_code }}</td>
                                        <td>{{ number_format($request->amount, 2) }}</td>
                                        <td>{{ $request->ac_no }}</td>
                                        <td>
                                            {{ ucfirst($request->category) }}
                                        </td>
                                        <td>
                                            {{ formatDateTime($request->withdraw_date) }}
                                        </td>
                                        <td>
                                            <label class="btn btn-sm btn-danger">
                                                {{ ucfirst($request->status) }}
                                            </label>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="{{ asset('admin/assets/js/watch.js') }}"></script>

    <script>
        function toggleDetails(groupId) {
            var detailsRow = document.getElementById('details-' + groupId);
            if (detailsRow.style.display === "none" || detailsRow.style.display === "") {
                detailsRow.style.display = "table";
            } else {
                detailsRow.style.display = "none";
            }
        }
    </script>

@endsection
