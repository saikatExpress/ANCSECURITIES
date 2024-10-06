<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ANC Securities Ltd | Dashboard</title>
    <link rel="shortcut icon" href="{{ asset('auth/ANCSECURITIES.png') }}" type="image/x-icon">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('admin/assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/bower_components/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/bower_components/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>

    <link rel="stylesheet" href="{{ asset('admin/assets/dist/css/AdminLTE.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/dist/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/ticker.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/withdraw.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/paginate.css') }}">
</head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header">
                <a href="{{ route('admin.dashboard') }}" class="logo">
                    <span class="logo-mini"><b>A</b>NC</span>
                    <span class="logo-lg"><b>ANCSECURITY</b>LTD</span>
                </a>

                <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <x-message/>
                </div>

                </nav>
            </header>

            <x-admin-sidebar/>

            <div id="contentArea">
            </div>

            <div id="clientsArea">
                <button class="close-btn" onclick="closeClientsArea()">×</button>
            </div>

            @yield('content')

            <x-admin-footer/>

            <!-- Control Sidebar -->
            <x-controll-sidebar/>
            <div class="control-sidebar-bg"></div>

        </div>
        <!-- ./wrapper -->

        <script src="{{ asset('admin/assets/bower_components/jquery/dist/jquery.min.js') }}"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="{{ asset('admin/assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <!-- FastClick -->
        <script src="{{ asset('admin/assets/bower_components/fastclick/lib/fastclick.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('admin/assets/dist/js/adminlte.min.js') }}"></script>
        <!-- Sparkline -->
        <script src="{{ asset('admin/assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
        <!-- jvectormap  -->
        <script src="{{ asset('admin/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
        <script src="{{ asset('admin/assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
        <!-- SlimScroll -->
        <script src="{{ asset('admin/assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
        <!-- ChartJS -->
        <script src="{{ asset('admin/assets/bower_components/chart.js/Chart.js') }}"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{ asset('admin/assets/dist/js/pages/dashboard2.js') }}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{ asset('admin/assets/dist/js/demo.js') }}"></script>

        <script>
            $(document).ready(function() {
                $('#createPermissionForm').on('submit', function(event) {
                    event.preventDefault();
                    $.ajax({
                        url: $(this).attr('action'),
                        type: 'POST',
                        data: $(this).serialize(),
                        success: function(response) {
                            Swal.fire({
                                title: 'Success!',
                                text: response.success,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                        },
                        error: function(xhr) {
                            console.error('Error creating permission:', xhr);
                        }
                    });
                });
            });
        </script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#clientSearchForm').on('submit', function(e) {
                    e.preventDefault(); // Prevent default form submission

                    var formData = $(this).serialize(); // Serialize form data

                    $.ajax({
                        url: $(this).attr('action'), // Get action URL from form
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            var clientsArea = $('#clientsArea');

                            clientsArea.empty();

                            if (response.pdf_url) {
                                // Create an iframe or embed element to display the PDF
                                var pdfHtml = '<iframe src="' + response.pdf_url + '" width="100%" height="800px" style="border: none;"></iframe>';

                                // Append the PDF viewer to the div
                                clientsArea.html(pdfHtml).show(); // Display results
                            } else {
                                clientsArea.html('<p>No PDF found for the provided code</p>').show(); // Show no results message
                            }
                        },
                        error: function(xhr) {
                            console.error('Error:', xhr.responseText);
                            $('#clientsArea').html('<p>An error occurred while searching.</p>').show();
                        }
                    });
                });
            });

            function closeClientsArea() {
                $('#clientsArea').hide();
            }
        </script>
    </body>
</html>
