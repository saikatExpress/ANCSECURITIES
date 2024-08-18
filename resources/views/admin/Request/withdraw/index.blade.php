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
                <a class="btn btn-sm btn-primary" href="{{ route('admin.withdrawrequest') }}">Create Withdraw Request</a>
            </p>
        </section>

        <section class="content">
            @if(session('message'))
                <div class="alert alert-success" id="successAlert">{{ session('message') }}</div>
            @endif

            @if(session('errors'))
                <div class="alert alert-danger errorAlert">{{ session('errors') }}</div>
            @endif
        </section>

        <div class="row">
            <div class="col-md-12">
                <h4>Request File Report</h4>
                <div style="width: 100%;box-shadow: 0 0 10px rgba(0,0,0,0.1);border-radius: 4px;background-color: #fff;">

                    @foreach ($combinedData as $group)
                        <div>
                            <h2>Created By: {{ $group['created_by'] }}</h2>
                            <p>Total Requests: {{ $group['total'] }}</p>
                            <button onclick="toggleDetails('{{ $group['created_by'] }}')">Toggle Details</button>

                            <!-- Hidden details section -->
                            <table class="styled-table" id="details-{{ $group['created_by'] }}" style="display: none;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Request ID</th>
                                        <th>Category</th>
                                        <th>Funds</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($group['details'] as $requestFile)
                                        <tr>
                                            <td>{{ $requestFile->id }}</td>
                                            <td>{{ $requestFile->request_id }}</td>
                                            <td>{{ $requestFile->category }}</td>
                                            <td>
                                                @foreach ($requestFile->funds as $fund)
                                                    {{ $fund->id }} ({{ $fund->amount }})<br>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
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
