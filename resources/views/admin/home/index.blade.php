
@extends('admin.layout.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <strong class="text-sm text-success fw-bold">Admin</strong>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Info boxes -->
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-time-outline"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Daily Attendance</span>
                            <div class="attendance-form">
                                <form id="attendanceForm1" action="{{ route('empattendance.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="start-time">Start Time</label>
                                        <input type="time" id="start-time" name="start_time" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text">Likes</span>
                        <span class="info-box-number">41,410</span>
                        </div>
                    </div>
                </div>

                <!-- fix for small devices only -->
                <div class="clearfix visible-sm-block"></div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                    <div class="info-box-content">
                    <span class="info-box-text">Sales</span>
                    <span class="info-box-number">760</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow">
                            <i class="ion ion-ios-people-outline"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Clients</span>
                            <span class="info-box-number">{{ number_format($totalUsers) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            @if (count($notifications) > 0)
                <div class="row">
                    <div class="ticker-container">
                        <div class="ticker">
                            @foreach ($notifications as $notification)
                                @if ($notification['type'] == 'limit')
                                    <div class="ticker-item">
                                        <a style="color: #fff;" href="{{ route('today.limit_request') }}">
                                            <i class="fa fa-exclamation-circle text-aqua"></i> New Limit Request from {{ $notification['data']->clients->name }}<br>
                                            <i class="fa fa-code text-info"></i> Trading Code: {{ $notification['data']->clients->trading_code }}<br>
                                            <i class="fa fa-money text-success"></i> Amount: <span style="font-weight:bold;">{{ $notification['data']->limit_amount }}</span>
                                        </a>
                                    </div>
                                @elseif($notification['type'] == 'withdraw')
                                    <div class="ticker-item">
                                        <a style="color: #fff;" href="{{ route('withdraw.request') }}">
                                            <i class="fa fa-money text-yellow"></i> New Withdraw Request from {{ $notification['data']->clients->name }}<br>
                                            <i class="fa fa-code text-info"></i> Trading Code: {{ $notification['data']->clients->trading_code }}<br>
                                            <i class="fa fa-money text-success"></i> Amount: <span style="font-weight:bold;">{{ $notification['data']->amount }}</span>
                                        </a>
                                    </div>
                                @elseif($notification['type'] == 'deposit')
                                    <div class="ticker-item">
                                        <a style="color: #fff;" href="{{ route('deposit.request') }}">
                                            <i class="fa fa-bank text-green"></i> New Deposit from {{ $notification['data']->clients->name }}<br>
                                            <i class="fa fa-code text-info"></i> Trading Code: {{ $notification['data']->clients->trading_code }}<br>
                                            <i class="fa fa-money text-success"></i> Amount: <span style="font-weight:bold;">{{ $notification['data']->amount }}</span>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            @if (auth()->user()->role === 'hr')
                <div class="row">
                    <div class="col-md-12">
                        <h4>Daily Attendance List</h4>
                    </div>
                </div>
            @endif


            @if (auth()->user()->role === 'admin')
                <div class="row">
                    <!-- Left col -->
                    <div class="col-md-8">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Visitors Report</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body no-padding">
                                <div class="row">
                                    <div class="col-md-9 col-sm-8">
                                    <div class="pad">
                                        <!-- Map will be created here -->
                                        <div id="world-map-markers" style="height: 325px;"></div>
                                    </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-sm-4">
                                    <div class="pad box-pane-right bg-green" style="min-height: 280px">
                                        <div class="description-block margin-bottom">
                                        <div class="sparkbar pad" data-color="#fff">90,70,90,70,75,80,70</div>
                                        <h5 class="description-header">8390</h5>
                                        <span class="description-text">Visits</span>
                                        </div>
                                        <!-- /.description-block -->
                                        <div class="description-block margin-bottom">
                                        <div class="sparkbar pad" data-color="#fff">90,50,90,70,61,83,63</div>
                                        <h5 class="description-header">30%</h5>
                                        <span class="description-text">Referrals</span>
                                        </div>
                                        <!-- /.description-block -->
                                        <div class="description-block">
                                            <div class="sparkbar pad" data-color="#fff">90,50,90,70,61,83,63</div>
                                            <h5 class="description-header">70%</h5>
                                            <span class="description-text">Organic</span>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- /.box -->
                        <div class="row">
                            <div class="col-md-6">
                            <!-- DIRECT CHAT -->
                            <div class="box box-warning direct-chat direct-chat-warning">
                                <div class="box-header with-border">
                                <h3 class="box-title">Direct Chat</h3>

                                <div class="box-tools pull-right">
                                    <span data-toggle="tooltip" title="3 New Messages" class="badge bg-yellow">3</span>
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts"
                                            data-widget="chat-pane-toggle">
                                    <i class="fa fa-comments"></i></button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                                    </button>
                                </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                <!-- Conversations are loaded here -->
                                <div class="direct-chat-messages">
                                    <!-- Message. Default to the left -->
                                    <div class="direct-chat-msg">
                                    <div class="direct-chat-info clearfix">
                                        <span class="direct-chat-name pull-left">Alexander Pierce</span>
                                        <span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>
                                    </div>
                                    <!-- /.direct-chat-info -->
                                    <img class="direct-chat-img" src="{{ asset('admin/assets/dist/img/user1-128x128.jpg') }}" alt="message user image">
                                    <!-- /.direct-chat-img -->
                                    <div class="direct-chat-text">
                                        Is this template really for free? That's unbelievable!
                                    </div>
                                    <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->

                                    <!-- Message to the right -->
                                    <div class="direct-chat-msg right">
                                    <div class="direct-chat-info clearfix">
                                        <span class="direct-chat-name pull-right">Sarah Bullock</span>
                                        <span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span>
                                    </div>
                                    <!-- /.direct-chat-info -->
                                    <img class="direct-chat-img" src="{{ asset('admin/assets/dist/img/user3-128x128.jpg') }}" alt="message user image">
                                    <!-- /.direct-chat-img -->
                                    <div class="direct-chat-text">
                                        You better believe it!
                                    </div>
                                    <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->

                                    <!-- Message. Default to the left -->
                                    <div class="direct-chat-msg">
                                    <div class="direct-chat-info clearfix">
                                        <span class="direct-chat-name pull-left">Alexander Pierce</span>
                                        <span class="direct-chat-timestamp pull-right">23 Jan 5:37 pm</span>
                                    </div>
                                    <!-- /.direct-chat-info -->
                                    <img class="direct-chat-img" src="{{ asset('admin/assets/dist/img/user1-128x128.jpg') }}" alt="message user image">
                                    <!-- /.direct-chat-img -->
                                    <div class="direct-chat-text">
                                        Working with AdminLTE on a great new app! Wanna join?
                                    </div>
                                    <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->

                                    <!-- Message to the right -->
                                    <div class="direct-chat-msg right">
                                    <div class="direct-chat-info clearfix">
                                        <span class="direct-chat-name pull-right">Sarah Bullock</span>
                                        <span class="direct-chat-timestamp pull-left">23 Jan 6:10 pm</span>
                                    </div>
                                    <!-- /.direct-chat-info -->
                                    <img class="direct-chat-img" src="{{ asset('admin/assets/dist/img/user3-128x128.jpg') }}" alt="message user image">
                                    <!-- /.direct-chat-img -->
                                    <div class="direct-chat-text">
                                        I would love to.
                                    </div>
                                    <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->

                                </div>
                                <!--/.direct-chat-messages-->

                                <!-- Contacts are loaded here -->
                                <div class="direct-chat-contacts">
                                    <ul class="contacts-list">
                                    <li>
                                        <a href="#">
                                        <img class="contacts-list-img" src="{{ asset('admin/assets/dist/img/user1-128x128.jpg') }}" alt="User Image">

                                        <div class="contacts-list-info">
                                                <span class="contacts-list-name">
                                                Count Dracula
                                                <small class="contacts-list-date pull-right">2/28/2015</small>
                                                </span>
                                            <span class="contacts-list-msg">How have you been? I was...</span>
                                        </div>
                                        <!-- /.contacts-list-info -->
                                        </a>
                                    </li>
                                    <!-- End Contact Item -->
                                    <li>
                                        <a href="#">
                                        <img class="contacts-list-img" src="{{ asset('admin/assets/dist/img/user7-128x128.jpg') }}" alt="User Image">

                                        <div class="contacts-list-info">
                                                <span class="contacts-list-name">
                                                Sarah Doe
                                                <small class="contacts-list-date pull-right">2/23/2015</small>
                                                </span>
                                            <span class="contacts-list-msg">I will be waiting for...</span>
                                        </div>
                                        <!-- /.contacts-list-info -->
                                        </a>
                                    </li>
                                    <!-- End Contact Item -->
                                    <li>
                                        <a href="#">
                                        <img class="contacts-list-img" src="{{ asset('admin/assets/dist/img/user3-128x128.jpg') }}" alt="User Image">

                                        <div class="contacts-list-info">
                                                <span class="contacts-list-name">
                                                Nadia Jolie
                                                <small class="contacts-list-date pull-right">2/20/2015</small>
                                                </span>
                                            <span class="contacts-list-msg">I'll call you back at...</span>
                                        </div>
                                        <!-- /.contacts-list-info -->
                                        </a>
                                    </li>
                                    <!-- End Contact Item -->
                                    <li>
                                        <a href="#">
                                        <img class="contacts-list-img" src="dist/img/user5-128x128.jpg" alt="User Image">

                                        <div class="contacts-list-info">
                                                <span class="contacts-list-name">
                                                Nora S. Vans
                                                <small class="contacts-list-date pull-right">2/10/2015</small>
                                                </span>
                                            <span class="contacts-list-msg">Where is your new...</span>
                                        </div>
                                        <!-- /.contacts-list-info -->
                                        </a>
                                    </li>
                                    <!-- End Contact Item -->
                                    <li>
                                        <a href="#">
                                        <img class="contacts-list-img" src="dist/img/user6-128x128.jpg" alt="User Image">

                                        <div class="contacts-list-info">
                                                <span class="contacts-list-name">
                                                John K.
                                                <small class="contacts-list-date pull-right">1/27/2015</small>
                                                </span>
                                            <span class="contacts-list-msg">Can I take a look at...</span>
                                        </div>
                                        <!-- /.contacts-list-info -->
                                        </a>
                                    </li>
                                    <!-- End Contact Item -->
                                    <li>
                                        <a href="#">
                                        <img class="contacts-list-img" src="dist/img/user8-128x128.jpg" alt="User Image">

                                        <div class="contacts-list-info">
                                                <span class="contacts-list-name">
                                                Kenneth M.
                                                <small class="contacts-list-date pull-right">1/4/2015</small>
                                                </span>
                                            <span class="contacts-list-msg">Never mind I found...</span>
                                        </div>
                                        <!-- /.contacts-list-info -->
                                        </a>
                                    </li>
                                    <!-- End Contact Item -->
                                    </ul>
                                    <!-- /.contatcts-list -->
                                </div>
                                <!-- /.direct-chat-pane -->
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                <form action="#" method="post">
                                    <div class="input-group">
                                    <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                                    <span class="input-group-btn">
                                            <button type="button" class="btn btn-warning btn-flat">Send</button>
                                        </span>
                                    </div>
                                </form>
                                </div>
                                <!-- /.box-footer-->
                            </div>
                            <!--/.direct-chat -->
                            </div>
                            <!-- /.col -->

                            <div class="col-md-6">
                            <!-- USERS LIST -->
                            <div class="box box-danger">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Latest Members</h3>

                                    <div class="box-tools pull-right">
                                        <span class="label label-danger">{{ count($latestUsers) }} New Members</span>
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="box-body no-padding">
                                    <ul class="users-list clearfix">
                                        @if (count($latestUsers) > 0)
                                            @foreach ($latestUsers as $user)
                                                <li>
                                                    @if ($user->profile_image == NULL)
                                                        <img src="{{ asset('admin/assets/dist/img/user1-128x128.jpg') }}" alt="User Image">
                                                    @else
                                                        <img src="{{ asset('storage/user_photo/' . $user->profile_image) }}" alt="User Image">
                                                    @endif
                                                    <a class="users-list-name" href="#">
                                                        {{ $user->name }}
                                                    </a>
                                                    <span class="users-list-date">{{ $user->created_at }}</span>
                                                </li>
                                            @endforeach
                                        @else
                                            <li>
                                                <img src="{{ asset('admin/assets/dist/img/user8-128x128.jpg') }}" alt="User Image">
                                                <a class="users-list-name" href="#">Norman</a>
                                                <span class="users-list-date">Yesterday</span>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="box-footer text-center">
                                    <a href="javascript:void(0)" class="uppercase">View All Users</a>
                                </div>
                            </div>
                            <!--/.box -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- TABLE: LATEST ORDERS -->
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Latest Orders</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Item</th>
                                    <th>Status</th>
                                    <th>Popularity</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                    <td>Call of Duty IV</td>
                                    <td><span class="label label-success">Shipped</span></td>
                                    <td>
                                    <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="pages/examples/invoice.html">OR1848</a></td>
                                    <td>Samsung Smart TV</td>
                                    <td><span class="label label-warning">Pending</span></td>
                                    <td>
                                    <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                    <td>iPhone 6 Plus</td>
                                    <td><span class="label label-danger">Delivered</span></td>
                                    <td>
                                    <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                    <td>Samsung Smart TV</td>
                                    <td><span class="label label-info">Processing</span></td>
                                    <td>
                                    <div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="pages/examples/invoice.html">OR1848</a></td>
                                    <td>Samsung Smart TV</td>
                                    <td><span class="label label-warning">Pending</span></td>
                                    <td>
                                    <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                    <td>iPhone 6 Plus</td>
                                    <td><span class="label label-danger">Delivered</span></td>
                                    <td>
                                    <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                    <td>Call of Duty IV</td>
                                    <td><span class="label label-success">Shipped</span></td>
                                    <td>
                                    <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                                    </td>
                                </tr>
                                </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer clearfix">
                            <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
                            </div>
                            <!-- /.box-footer -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->

                    <div class="col-md-4">
                        <div class="info-box bg-yellow">
                            <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Inventory</span>
                                <span class="info-box-number">5,200</span>

                                <div class="progress">
                                    <div class="progress-bar" style="width: 50%"></div>
                                </div>
                                <span class="progress-description">
                                    50% Increase in 30 Days
                                </span>
                            </div>
                        </div>

                    <div class="info-box bg-green">
                        <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Mentions</span>
                            <span class="info-box-number">92,050</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 20%"></div>
                            </div>
                            <span class="progress-description">
                                20% Increase in 30 Days
                            </span>
                        </div>
                    </div>

                    <div class="info-box bg-red">
                        <span class="info-box-icon">
                            <i class="ion ion-ios-cloud-download-outline"></i>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">Downloads</span>
                            <span class="info-box-number">114,381</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 70%"></div>
                            </div>
                            <span class="progress-description">
                                70% Increase in 30 Days
                            </span>
                        </div>
                    </div>

                    <div class="info-box bg-aqua">
                        <span class="info-box-icon">
                            <i class="ion-ios-chatbubble-outline"></i>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">Direct Messages</span>
                            <span class="info-box-number">163,921</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 40%"></div>
                            </div>
                            <span class="progress-description">
                                40% Increase in 30 Days
                            </span>
                        </div>
                    </div>

                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Browser Usage</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="chart-responsive">
                                        <div id="barChart" class="bar-chart"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <ul class="legend">
                                        <li><span class="color-box" style="background-color: #FF6384;"></span> Chrome</li>
                                        <li><span class="color-box" style="background-color: #36A2EB;"></span> IE</li>
                                        <li><span class="color-box" style="background-color: #FFCE56;"></span> Firefox</li>
                                        <li><span class="color-box" style="background-color: #4BC0C0;"></span> Safari</li>
                                        <li><span class="color-box" style="background-color: #9966FF;"></span> Opera</li>
                                        <li><span class="color-box" style="background-color: #C9CBCF;"></span> Navigator</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="box-footer no-padding">
                            <ul class="nav nav-pills nav-stacked">
                                <li>
                                    <a href="#">
                                        United States of America
                                        <span class="pull-right text-red">
                                            <i class="fa fa-angle-down"></i>
                                            12%
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        India
                                        <span class="pull-right text-green">
                                            <i class="fa fa-angle-up"></i>
                                            4%
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">China
                                        <span class="pull-right text-yellow">
                                            <i class="fa fa-angle-left"></i>
                                            0%
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div> --}}
                    </div>

                    <!-- PRODUCT LIST -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                        <h3 class="box-title">Recently Added Products</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                        <ul class="products-list product-list-in-box">
                            <li class="item">
                            <div class="product-img">
                                <img src="dist/img/default-50x50.gif" alt="Product Image">
                            </div>
                            <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">Samsung TV
                                <span class="label label-warning pull-right">$1800</span></a>
                                <span class="product-description">
                                    Samsung 32" 1080p 60Hz LED Smart HDTV.
                                    </span>
                            </div>
                            </li>
                            <!-- /.item -->
                            <li class="item">
                            <div class="product-img">
                                <img src="dist/img/default-50x50.gif" alt="Product Image">
                            </div>
                            <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">Bicycle
                                <span class="label label-info pull-right">$700</span></a>
                                <span class="product-description">
                                    26" Mongoose Dolomite Men's 7-speed, Navy Blue.
                                    </span>
                            </div>
                            </li>
                            <!-- /.item -->
                            <li class="item">
                            <div class="product-img">
                                <img src="dist/img/default-50x50.gif" alt="Product Image">
                            </div>
                            <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">Xbox One <span
                                    class="label label-danger pull-right">$350</span></a>
                                <span class="product-description">
                                    Xbox One Console Bundle with Halo Master Chief Collection.
                                    </span>
                            </div>
                            </li>
                            <!-- /.item -->
                            <li class="item">
                            <div class="product-img">
                                <img src="dist/img/default-50x50.gif" alt="Product Image">
                            </div>
                            <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">PlayStation 4
                                <span class="label label-success pull-right">$399</span></a>
                                <span class="product-description">
                                    PlayStation 4 500GB Console (PS4)
                                    </span>
                            </div>
                            </li>
                            <!-- /.item -->
                        </ul>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-center">
                        <a href="javascript:void(0)" class="uppercase">View All Products</a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
            @endif

        </section>
        <!-- /.content -->
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Browser history data from the server-side
            const browserHistory = @json($browserHistory);

            // Function to count the occurrences of each browser type
            function countBrowsers(history) {
                const browserCount = {
                    Chrome: 0,
                    IE: 0,
                    Firefox: 0,
                    Safari: 0,
                    Opera: 0,
                    Navigator: 0
                };

                history.forEach(entry => {
                    if (entry) {
                        if (entry.includes("Chrome")) {
                            browserCount.Chrome++;
                        } else if (entry.includes("MSIE") || entry.includes("Trident")) {
                            browserCount.IE++;
                        } else if (entry.includes("Firefox")) {
                            browserCount.Firefox++;
                        } else if (entry.includes("Safari") && !entry.includes("Chrome")) {
                            browserCount.Safari++;
                        } else if (entry.includes("Opera") || entry.includes("OPR")) {
                            browserCount.Opera++;
                        } else if (entry.includes("Navigator")) {
                            browserCount.Navigator++;
                        }
                    }
                });

                return browserCount;
            }

            const browserData = countBrowsers(browserHistory);
            const total = Object.values(browserData).reduce((sum, count) => sum + count, 0);
            const chartContainer = document.getElementById('barChart');

            Object.keys(browserData).forEach(browser => {
                const percentage = ((browserData[browser] / total) * 100).toFixed(2);

                const barContainer = document.createElement('div');
                barContainer.classList.add('bar');

                const barLabel = document.createElement('div');
                barLabel.classList.add('bar-label');
                barLabel.textContent = `${browser}: ${percentage}%`;

                const barValue = document.createElement('div');
                barValue.classList.add('bar-value');
                barValue.style.width = `${percentage}%`;
                barValue.style.backgroundColor = getColorForBrowser(browser);

                const barPercentage = document.createElement('div');
                barPercentage.classList.add('bar-percentage');
                barPercentage.textContent = `${percentage}%`;

                barValue.appendChild(barPercentage);
                barContainer.appendChild(barLabel);
                barContainer.appendChild(barValue);
                chartContainer.appendChild(barContainer);
            });

            function getColorForBrowser(browser) {
                const colors = {
                    Chrome: '#FF6384',
                    IE: '#36A2EB',
                    Firefox: '#FFCE56',
                    Safari: '#4BC0C0',
                    Opera: '#9966FF',
                    Navigator: '#C9CBCF'
                };
                return colors[browser];
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the current time
            var now = new Date();
            var hours = now.getHours().toString().padStart(2, '0');
            var minutes = now.getMinutes().toString().padStart(2, '0');

            // Set the current time as the default value
            document.getElementById('start-time').value = hours + ':' + minutes;
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#attendanceForm1').on('submit', function(event) {
                event.preventDefault();
                console.log('Form submit event prevented'); // Debugging line

                var formData = $(this).serialize();

                // Send the data to the server via AJAX
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        if(response && response.error === false){
                            toastr.error('Failed to record attendance. Already you stored.');
                        }else{
                            toastr.success('Attendance recorded successfully!');
                        }
                    },
                    error: function(xhr) {
                        // Show an error notification
                        toastr.error('Failed to record attendance. Please try again.');
                    }
                });
            });
        });
    </script>
@endsection


