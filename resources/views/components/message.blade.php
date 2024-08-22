<ul class="nav navbar-nav">
    <!-- Messages: style can be found in dropdown.less-->
    <li class="dropdown messages-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-envelope-o"></i>
            <span class="label label-success">{{ (count($messages)) ?? 0 }}</span>
        </a>
        <ul class="dropdown-menu">
            <li class="header">You have {{ (count($messages)) ?? 0 }} messages</li>
            <li>
                <ul class="menu">
                    @if (count($messages) > 0)
                        @foreach ($messages as $msg)
                            <li>
                                <a href="#">
                                    <div class="pull-left">
                                        <img src="{{ asset('admin/assets/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                                    </div>
                                    <h4>
                                        {{ implode(' ', array_slice(str_word_count($msg->name, 1), 0, 2)) . ' ..' }}
                                        <small><i class="fa fa-clock-o"></i> {{ $msg->created_at->diffForHumans() }}</small>
                                    </h4>
                                    <p>
                                        Email : {{ $msg->email }}
                                    </p>
                                    <p>
                                        Subject : {{ $msg->subject }}
                                    </p>
                                </a>
                            </li>
                        @endforeach
                    @else
                        <li>
                            <a href="#">
                                <div class="pull-left">
                                    <img src="{{ asset('admin/assets/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                                </div>
                                <h4>
                                    Support Team
                                    <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                </h4>
                                <p>Why not buy a new awesome theme?</p>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
            <li class="footer"><a href="#">See All Messages</a></li>
        </ul>
    </li>
    <!-- Notifications: style can be found in dropdown.less -->
    <li class="dropdown notifications-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell-o"></i>
            <span class="label label-warning">{{ count($notifications) }}</span>
        </a>
        <ul class="dropdown-menu">
            <li class="header">You have {{ count($notifications) }} notifications</li>
            <li>
                <!-- Inner menu: contains the actual data -->
                <ul class="menu">
                    @foreach($notifications as $notification)
                        <li>
                            <a href="#">
                                @if($notification['type'] == 'limit')
                                    <i class="fa fa-exclamation-circle text-aqua"></i> New Limit Request from {{ $notification['data']->clients->name }}<br>
                                    <i class="fa fa-code text-info"></i> Trading Code: {{ $notification['data']->clients->trading_code }}<br>
                                    <i class="fa fa-money text-success"></i> Amount: <span style="font-weight:bold;">{{ $notification['data']->limit_amount }}</span><br>
                                @elseif($notification['type'] == 'withdraw')
                                    <i class="fa fa-money text-yellow"></i> New Withdraw Request from {{ $notification['data']->clients->name }}<br>
                                    <i class="fa fa-code text-info"></i> Trading Code: {{ $notification['data']->clients->trading_code }}<br>
                                    <i class="fa fa-money text-success"></i> Amount: <span style="font-weight:bold;">{{ $notification['data']->amount }}</span><br>
                                @elseif($notification['type'] == 'deposit')
                                    <i class="fa fa-bank text-green"></i> New Deposit from {{ $notification['data']->clients->name }}<br>
                                    <i class="fa fa-code text-info"></i> Trading Code: {{ $notification['data']->clients->trading_code }}<br>
                                    <i class="fa fa-money text-success"></i> Amount: <span style="font-weight:bold;">{{ $notification['data']->amount }}</span><br>
                                @endif
                                <small><i class="fa fa-clock-o"></i> {{ $notification['created_at']->format('Y-m-d h:i A') }}</small>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
            <li class="footer"><a href="#">View all</a></li>
        </ul>
    </li>


    <!-- Tasks: style can be found in dropdown.less -->
    <li class="dropdown tasks-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-flag-o"></i>
        <span class="label label-danger">9</span>
        </a>
        <ul class="dropdown-menu">
        <li class="header">You have 9 tasks</li>
        <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">
            <li><!-- Task item -->
                <a href="#">
                <h3>
                    Design some buttons
                    <small class="pull-right">20%</small>
                </h3>
                <div class="progress xs">
                    <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                        aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                    <span class="sr-only">20% Complete</span>
                    </div>
                </div>
                </a>
            </li>
            <!-- end task item -->
            <li>
                <a href="#">
                <h3>
                    Create a nice theme
                    <small class="pull-right">40%</small>
                </h3>
                <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar"
                        aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                    <span class="sr-only">40% Complete</span>
                    </div>
                </div>
                </a>
            </li>
            <!-- end task item -->
            <li>
                <a href="#">
                <h3>
                    Some task I need to do
                    <small class="pull-right">60%</small>
                </h3>
                <div class="progress xs">
                    <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar"
                        aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                    <span class="sr-only">60% Complete</span>
                    </div>
                </div>
                </a>
            </li>
            <!-- end task item -->
            <li><!-- Task item -->
                <a href="#">
                <h3>
                    Make beautiful transitions
                    <small class="pull-right">80%</small>
                </h3>
                <div class="progress xs">
                    <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar"
                        aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                    <span class="sr-only">80% Complete</span>
                    </div>
                </div>
                </a>
            </li>
            <!-- end task item -->
            </ul>
        </li>
        <li class="footer">
            <a href="#">View all tasks</a>
        </li>
        </ul>
    </li>
    <!-- User Account: style can be found in dropdown.less -->
    <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            @if (auth()->user()->profile_image)
                <img src="{{ asset('storage/user_photo/profile/' . auth()->user()->profile_image) }}" class="user-image" alt="Image">
            @else
                <img src="{{ asset('admin/assets/dist/img/user2-160x160.jpg') }}" class="user-image" alt="Image">
            @endif
        <span class="hidden-xs">{{ auth()->user()->name }}</span>
        </a>
        <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header">
            @if (auth()->user()->profile_image)
                <img src="{{ asset('storage/user_photo/profile/' . auth()->user()->profile_image) }}" class="img-circle" alt="Image">
            @else
                <img src="{{ asset('admin/assets/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="Image">
            @endif
            <p>
                {{ auth()->user()->name }} - {{ strtoupper(auth()->user()->role) }}
                <small>Member since Nov. {{ date('Y', auth()->user()->created_at->timestamp) }}</small>
            </p>
        </li>
        <!-- Menu Body -->
        <li class="user-body">
            <div class="row">
            <div class="col-xs-4 text-center">
                <a href="#">Followers</a>
            </div>
            <div class="col-xs-4 text-center">
                <a href="#">Sales</a>
            </div>
            <div class="col-xs-4 text-center">
                <a href="#">Friends</a>
            </div>
            </div>
            <!-- /.row -->
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
            <div class="pull-left">
            <a href="{{ route('profile.us') }}" class="btn btn-default btn-flat">Profile</a>
            </div>
            <div class="pull-right">
            <a href="{{ route('logout.us') }}" class="btn btn-default btn-flat">Sign out</a>
            </div>
        </li>
        </ul>
    </li>
    <!-- Control Sidebar Toggle Button -->
    <li>
        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
    </li>
</ul>
