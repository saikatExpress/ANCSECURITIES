@extends('admin.layout.app')
<link rel="stylesheet" href="{{ asset('admin/assets/css/permission.css') }}">
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
                <li class="active">Dashboard</li>
            </ol>
        </section>
        <section class="content">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between;">
                    <h3>Create Permission</h3>
                    <button type="button" class="btn btn-sm btn-primary permissionListBtn">Permission List</button>
                </div>
                <div class="card-body">
                    <form id="createPermissionForm" action="{{ route('permission.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Permission Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter permission name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>

                <div id="contentArea1" class="table-responsive">

                </div>

            </div>

        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('admin/assets/js/watch.js') }}"></script>
    <script src="{{ asset('admin/assets/js/permission.js') }}"></script>
@endsection
