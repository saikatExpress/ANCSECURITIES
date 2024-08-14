    @extends('admin.layout.app')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>

    @section('content')
        <div class="content-wrapper">
            <section class="content-header">
                <x-sub-header/>
                <h1>
                    Dashboard
                    <strong class="text-sm text-success fw-bold">Admin</strong>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">{{ $pageTitle }}</li>
                </ol>
            </section>

            <section class="content">

                @if(session('message'))
                    <div class="alert alert-success" id="successAlert">
                        {{ session('message') }}
                    </div>
                @endif

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Request List</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Select Request Type</label>
                                    <select name="requestType" id="requestType" class="form-control">
                                        <option value="" selected disabled>Select</option>
                                        <option value="withdraw">Withdraw Request</option>
                                        <option value="deposit">Deposit Request</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <table id="example11" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Whatsapp</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Perform</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($limitRequests as $request)
                                    <tr class="list-item">
                                        <td>{{ $request->id }}</td>

                                        <td>
                                            {{ $request->clients->name }}
                                        </td>
                                        <td>
                                            <a href="">
                                                {{ $request->clients->whatsapp }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ number_format($request->limit_amount) }}
                                        </td>
                                        <td>
                                            {{ $request->created_at->format('d-M-Y') }}
                                        </td>

                                        @if ($request->status === 'pending')
                                            <td>
                                                <label for="" class="btn btn-sm btn-danger">Pending</label>
                                            </td>
                                        @elseif ($request->status === 'approved')
                                            <td>
                                                <label for="" class="btn btn-sm btn-success">Approved</label>
                                            </td>
                                        @else
                                            <td>
                                                <label for="" class="btn btn-sm btn-Warning">Declined</label>
                                            </td>
                                        @endif

                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" class="custom-control-input toggle-status" id="switch{{ $request->id }}"
                                                {{ $request->status === 'approved' ? 'checked' : '' }}
                                                data-id="{{ $request->id }}" data-action="{{ route('request.toggle', $request->id) }}">
                                                <span class="slider round"></span>
                                            </label>
                                        </td>

                                        <td>
                                            <button type="button" class="btn btn-sm btn-danger deleteBtn" data-id="{{ $request->id }}">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Browser</th>
                                    <th>Platform(s)</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Perform</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </section>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="{{ asset('admin/assets/js/limit.js') }}"></script>
        <script src="{{ asset('admin/assets/js/watch.js') }}"></script>

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
                $('.toggle-status').change(function() {
                    var requestId = $(this).data('id');
                    var actionUrl = $(this).data('action');
                    var status = $(this).prop('checked') ? 'approved' : 'canceled'; // Determine new status based on checkbox state

                    $.ajax({
                        url: actionUrl,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            status: status
                        },
                        success: function(response) {
                            toastr.success('Status updated successfully.');
                        },
                        error: function(xhr) {
                            console.error('Error updating status:', xhr.responseText);
                            // Handle error, show error message, etc.
                        }
                    });
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                // Listen for change in select dropdown
                $('#requestType').change(function() {
                    var selectedType = $(this).val();

                    $.ajax({
                        url: '{{ route('fetch.requests') }}', // Replace with your Laravel route
                        type: 'GET',
                        data: {
                            type: selectedType
                        },
                        success: function(response) {
                            $('#example11 tbody').empty(); // Clear existing rows

                            $.each(response, function(index, request) {
                                var statusLabel = getStatusLabel(request.status);

                                var row = '<tr class="list-item">' +
                                    '<td>' + request.id + '</td>' +
                                    '<td>' + request.clients.name + '</td>' +
                                    '<td><a href="tel:' + request.clients.whatsapp + '">' + request.clients.whatsapp + '</a></td>' +
                                    '<td>' + numberWithCommas(request.amount) + '</td>' +
                                    '<td>' + formatDate(request.created_at) + '</td>' +
                                    '<td>' + statusLabel + '</td>' +
                                    '<td>' +
                                    '<label class="switch">' +
                                    '<input type="checkbox" class="custom-control-input toggle-status" id="switch' + request.id + '"' +
                                    (request.status === 'approved' ? ' checked' : '') +
                                    ' data-id="' + request.id + '" data-action="{{ route('request.toggle', $request->id) }}">' +
                                    '<span class="slider round"></span>' +
                                    '</label>' +
                                    '</td>' +
                                    '<td>' +
                                    '<button type="button" class="btn btn-sm btn-danger deleteBtn" data-id="' + request.id + '">' +
                                    'Delete' +
                                    '</button>' +
                                    '</td>' +
                                    '</tr>';

                                $('#example11 tbody').append(row);
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching data:', error);
                        }
                    });
                });

                // Function to get status label based on status
                function getStatusLabel(status) {
                    if (status === 'pending') {
                        return '<label class="btn btn-sm btn-danger">Pending</label>';
                    } else if (status === 'approved') {
                        return '<label class="btn btn-sm btn-success">Approved</label>';
                    } else {
                        return '<label class="btn btn-sm btn-warning">Declined</label>';
                    }
                }

                // Function to format number with commas
                function numberWithCommas(x) {
                    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }

                // Function to format date
                function formatDate(dateString) {
                    var date = new Date(dateString);
                    return date.toLocaleDateString();
                }
            });
        </script>

    @endsection
