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
                    Add News
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
              <h3 class="box-title">News List</h3>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Quetos</th>
                        <th>Created By</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sl = 1;
                    @endphp
                    @foreach ($news as $item)
                        <tr class="list-item">
                            <td>{{ $sl }}</td>
                            <td>
                                {{ $item->news_title }}
                            </td>
                            <td>
                                {{ $item->quotes }}
                            </td>
                            <td>
                                {{ ($item->created_by) ?? 'ANC ADMIN' }}
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary editBtn"
                                    data-id="{{ $item->id }}" data-name="{{ $item->leave_type }}"
                                    data-number_of_leave="{{ $item->number_of_leave }}"
                                    data-toggle="modal" data-target="#editModal">
                                    Edit
                                </button>
                                <button type="button" class="btn btn-sm btn-danger deleteBtn" data-id="{{ $item->id }}">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        @php
                            $sl++;
                        @endphp
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
                    <h4 class="modal-title">Add News</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('news.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="">News Title</label>
                            <input type="text" class="form-control" name="news_title" placeholder="News title..">
                            @error('news_title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Quotes</label>
                            <textarea name="quotes" class="form-control" placeholder="write here or copy text.."></textarea>
                            @error('quotes')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" class="form-control" placeholder="write here or copy text.."></textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Add Image</label>
                            <input type="file" class="form-control" name="news_image">
                            @error('news_image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tags">Tags</label>
                            <input type="text" class="form-control" name="tags" id="tags" placeholder="Enter tags separated by commas">
                            <small class="form-text text-muted">You can add multiple tags separated by commas (e.g., finance, investment, stocks).</small>
                        </div>

                        <button type="submit" class="btn btn-primary">Add News</button>
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
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Update Leave Type</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('leave.update') }}" method="post">
                        @csrf
                        <input type="hidden" name="leaveId" id="leaveId">
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" class="form-control" id="ltype" name="leave_type" placeholder="Leave type..">
                            @error('leave_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Number of leave</label>
                            <input type="text" class="form-control" id="noOfleav" name="number_of_leave">
                            @error('number_of_leave')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update Leave</button>
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
    <script src="{{ asset('admin/assets/js/news.js') }}"></script>

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
