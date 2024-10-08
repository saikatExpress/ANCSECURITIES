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
                        <h3 class="box-title">Deposit Request List : </h3>
                    </div>
                    <div class="box-body">

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
                                            {{ number_format($request->amount) }}
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
                                                data-id="{{ $request->id }}" data-action="{{ route('request.deposit', $request->id) }}">
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

    @endsection
