<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                @if (auth()->user()->profile_image)
                    <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" class="img-circle" alt="Image">
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
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat">
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
                    {{-- <li class="active">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="fa fa-circle-o"></i>
                            Dashboard v2
                        </a>
                    </li> --}}
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
                        <a href="pages/layout/top-nav.html">
                            <i class="fa fa-circle-o"></i>
                            Create User
                        </a>
                    </li>
                    <li>
                        <a href="pages/layout/boxed.html">
                            <i class="fa fa-circle-o"></i>
                            User List
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('role.list') }}">
                            <i class="fa fa-circle-o"></i>
                            Role
                        </a>
                    </li>
                    <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Permission</a></li>
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
                            <i class="fa fa-circle-o"></i>
                            Form Upload
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('form.list') }}">
                            <i class="fa fa-circle-o"></i>
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
                            <i class="fa fa-circle-o"></i>
                            Add Staff
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('staff.list') }}">
                            <i class="fa fa-circle-o"></i>
                            Staff List
                        </a>
                    </li>
                    <li>
                        <a href="pages/UI/buttons.html">
                            <i class="fa fa-circle-o"></i>
                            Staff Salary
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('staff.attendance') }}">
                            <i class="fa fa-circle-o"></i>
                            Staff Attendance
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('leave.list') }}">
                            <i class="fa fa-circle-o"></i>
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
                    <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> Attendance Report</a></li>
                    <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Salary Report</a></li>
                    <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Leave Report</a></li>
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
                        <a href="{{ route('about.create') }}"><i class="fa fa-circle-o"></i>
                            About
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('director.create') }}"><i class="fa fa-circle-o"></i>
                            Board Directors
                        </a>
                    </li>
                    <li>
                        <a href="pages/tables/data.html"><i class="fa fa-circle-o"></i>
                            Management Teams
                        </a>
                    </li>
                    <li>
                        <a href="pages/tables/data.html"><i class="fa fa-circle-o"></i>
                            Sister Of Concern
                        </a>
                    </li>
                    <li>
                        <a href="pages/tables/data.html"><i class="fa fa-circle-o"></i>
                            FAQ
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
                            <i class="fa fa-circle-o"></i>
                            Add Banner
                        </a>
                    </li>
                    <li>
                        <a href="pages/examples/profile.html">
                            <i class="fa fa-circle-o"></i>
                            Banner List
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
                            <i class="fa fa-circle-o"></i>
                            Upload Portfolio
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('portfolio.list') }}">
                            <i class="fa fa-circle-o"></i>
                            Portfolio List
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
                            <i class="fa fa-circle-o"></i>
                            Add DP
                        </a>
                    </li>
                    <li>
                        <a href="pages/examples/profile.html">
                            <i class="fa fa-circle-o"></i>
                            DP List
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
                    <a href="#"><i class="fa fa-circle-o"></i> Level One
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                        <li class="treeview">
                        <a href="#"><i class="fa fa-circle-o"></i> Level Two
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                        </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
            </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
