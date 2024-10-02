<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                @if (auth()->user()->profile_image)
                    <img src="{{ asset('storage/user_photo/profile/' . auth()->user()->profile_image) }}" class="img-circle" alt="Image">
                @else
                    <img src="{{ asset('admin/assets/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="Image">
                @endif
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="{{ route('search.clients') }}" method="POST" id="clientSearchForm" class="sidebar-form">
            @csrf
            <div class="input-group">
                <input type="text" name="search_code" id="search_code" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" class="btn btn-flat">
                    <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">

            <li class="header">MAIN NAVIGATION</li>

            <li class="active treeview menu-open">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="fa fa-circle-o"></i>
                            Home
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>USER</span>
                    <span class="pull-right-container">
                        <span class="label label-primary pull-right">4</span>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('create.user') }}">
                            <i class="fa fa-user-plus"></i>
                            Create User
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.list') }}">
                            <i class="fa fa-users"></i>
                            User List
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.list') }}">
                            <i class="fa fa-users"></i>
                            Admin List
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('create.bo') }}">
                            <i class="fa fa-id-card"></i>
                            Add BO ID
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('role.list') }}">
                            <i class="fa fa-user-tag"></i>
                            Role
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('create.permissions') }}">
                            <i class="fa fa-key"></i>
                            Permission
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Forms</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('create.form') }}">
                            <i class="fa fa-upload"></i>
                            Form Upload
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('form.list') }}">
                            <i class="fa fa-list"></i>
                            Form List
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>HRM</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('staff.create') }}">
                            <i class="fa fa-user-plus"></i>
                            Add Staff
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('staff.list') }}">
                            <i class="fa fa-users"></i>
                            Staff List
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('employee.salary') }}">
                            <i class="fa fa-money"></i>
                            Staff Salary
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('staff.attendance') }}">
                            <i class="fa fa-calendar-check-o"></i>
                            Staff Attendance
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('leave.list') }}">
                            <i class="fa fa-calendar-times-o"></i>
                            Leave
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>Report</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('attendance.report') }}">
                            <i class="fa fa-calendar-check-o"></i>
                            Attendance Report
                        </a>
                    </li>
                    <li>
                        <a href="pages/forms/advanced.html">
                            <i class="fa fa-money"></i>
                            Salary Report
                        </a>
                    </li>
                    <li>
                        <a href="pages/forms/editors.html">
                            <i class="fa fa-calendar-times-o"></i>
                            Leave Report
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('expense.report') }}">
                            <i class="fa fa-calendar-times-o"></i>
                            Expense Report
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-file-text"></i> <span>Client Request</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('manual.request') }}">
                            <i class="fa fa-clock-o"></i>
                            Manual Request
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('today.limit_request') }}">
                            <i class="fa fa-clock-o"></i>
                            Todays Limit Request
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('declined.request') }}">
                            <i class="fa fa-times"></i>
                            Decline Request
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('all.request') }}">
                            <i class="fa fa-list"></i>
                            All Request
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('withdraw.request') }}">
                            <i class="fa fa-money"></i>
                            Withdraw Request
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('deposit.request') }}">
                            <i class="fa fa-bank"></i>
                            Deposit Request
                        </a>
                    </li>
                </ul>
            </li>


            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>Company</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('about.create') }}"><i class="fa fa-info-circle"></i> About</a>
                    </li>
                    <li>
                        <a href="{{ route('director.create') }}"><i class="fa fa-users"></i> Board Directors</a>
                    </li>
                    <li>
                        <a href="pages/tables/data.html"><i class="fa fa-users"></i> Management Teams</a>
                    </li>
                    <li>
                        <a href="pages/tables/data.html"><i class="fa fa-building-o"></i> Sister Of Concern</a>
                    </li>
                    <li>
                        <a href="pages/tables/data.html"><i class="fa fa-question-circle"></i> FAQ</a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dollar"></i> <span>Account</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('create.expense') }}">
                            <i class="fa fa-money"></i>
                            Add Expense
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('expense.list') }}">
                            <i class="fa fa-list"></i>
                            Expense List
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('create.product') }}">
                            <i class="fa fa-cube"></i>
                            Add Product
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fa fa-list-alt"></i>
                            Product List
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fa fa-hand-o-right"></i>
                            Assign Product
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('account.balance') }}">
                            <i class="fa fa-balance-scale"></i>
                            Account Balance
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-briefcase"></i> <span>Work Activities</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('add.work') }}">
                            <i class="fa fa-plus-square"></i>
                            Add Work
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('work.list') }}">
                            <i class="fa fa-list-ul"></i>
                            Work List
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('create.product') }}">
                            <i class="fa fa-cogs"></i>
                            Work Manage
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{{ route('bo.list') }}">
                    <i class="fa fa-th"></i> <span>BO FORM</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-green">{{ $totalForms }}</small>
                    </span>
                </a>
            </li>

            <li>
                <a href="{{ route('gallary.list') }}">
                    <i class="fa fa-th"></i> <span>GALLERY</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-green">5</small>
                    </span>
                </a>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>Banner</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('create.banner') }}">
                            <i class="fa fa-plus-circle"></i> Add Banner
                        </a>
                    </li>
                    <li>
                        <a href="pages/examples/profile.html">
                            <i class="fa fa-list"></i> Banner List
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa-solid fa-file-pdf"></i> <span>Portfolio Statement</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('create.portfolio') }}">
                            <i class="fa fa-upload"></i> Upload Portfolio
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('portfolio.list') }}">
                            <i class="fa fa-list-alt"></i> Portfolio List
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('assign.portfolio') }}">
                            <i class="fa fa-list-alt"></i> Assign Portfolio
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('assign.portfolio_list') }}">
                            <i class="fa fa-list-alt"></i> Assign Portfolio List
                        </a>
                    </li>
                </ul>
            </li>

           <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>DP</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('create.dp') }}">
                            <i class="fa fa-plus-circle"></i> Add DP
                        </a>
                    </li>
                    <li>
                        <a href="pages/examples/profile.html">
                            <i class="fa fa-list"></i> DP List
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="pages/calendar.html">
                    <i class="fa fa-calendar"></i> <span>Calendar</span>
                    <span class="pull-right-container">
                    <small class="label pull-right bg-red">3</small>
                    <small class="label pull-right bg-blue">17</small>
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ route('news.portal') }}">
                    <i class="fa-solid fa-newspaper"></i> <span>News Portal</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-yellow">12</small>
                        <small class="label pull-right bg-green">16</small>
                        <small class="label pull-right bg-red">5</small>
                    </span>
                </a>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa-solid fa-gear"></i> <span>Settings</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li>
                        <a href="{{ route('designation.list') }}">
                            <i class="fa fa-circle-o"></i>
                            Designation
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('department.list') }}">
                            <i class="fa fa-circle-o"></i>
                            Department
                        </a>
                    </li>

                    <li class="treeview">
                        <a href="#"><i class="fa fa-circle-o"></i> Settings
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('project.setting') }}">
                                    <i class="fa fa-circle-o"></i>
                                    Project Setting
                                </a>
                            </li>

                            <li class="treeview">
                                <a href="#"><i class="fa fa-circle-o"></i> Custom Setting
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li>
                                        <a href="{{ route('modification') }}">
                                            <i class="fa fa-circle-o"></i>
                                            Modification
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-circle-o"></i> Level One</a>
                        </li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
