<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
       <!-- <img src="{{asset('public/assets/TAMlogo.jpg')}}" height="100px" class="rounded" width="100px" alt="Italian Trulli"> -->
        <img src="{{asset('public/assets/TAMlogo.png')}}" class="img-fluid" alt="Responsive image"  height="150px" class="rounded" width="150px">
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                   @can('chat_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/counselorassignment_accsess*") ? "menu-open" : "" }} {{ request()->is("admin/counselorcurrentcases*") ? "menu-open" : "" }} {{ request()->is("admin/counselor-past-cases*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                        <!-- <i class="fa fa-envelope" aria-hidden="true"> -->
                        <i class="fa-fw nav-icon fas fa-user-tie"></i>

                        </i>
                            <p>
                            {{ trans('global.chat') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('counselorassignment_accsess')
                                <li class="nav-item">
                                    <a href="{{ route("admin.counselorassignments.index") }}" class="nav-link {{ request()->is("admin/counselorassignments") || request()->is("admin/counselorassignments/*") ? "active" : "" }}">
                                       <i class="fa-fw nav-icon fas fa-user-tie"></i>
                                        <p> Pending Chats </p>
                                    </a>
                                </li>
                            @endcan
                            @can('counselor_current_cases_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.counselorcurrentcases.index") }}" class="nav-link {{ request()->is("admin/counselorcurrentcases") || request()->is("admin/counselorcurrentcases/*") ? "active" : "" }}">
                                       <i class="fa-fw nav-icon fas fa-user-tie"></i>
                                        <p> Current Chats </p>
                                    </a>
                                </li>
                            @endcan
                            @can('counselor_past_cases_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.counselor-past-cases.index") }}" class="nav-link {{ request()->is("admin/counselor-past-cases") || request()->is("admin/counselor-past-cases/*") ? "active" : "" }}">
                                       <i class="fa-fw nav-icon fas fa-user-tie"></i>
                                        <p> Past Chats </p>
                                    </a>
                                </li>
                            @endcan
                            @can('my_chat_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.counselors.mychatAdmin") }}" class="nav-link {{ request()->is("admin/counselors") || request()->is("admin/counselors/mychatAdmin") ? "active" : "" }}">
                                    <i class="fa-fw nav-icon fas fa-user-tie"></i>
                                        <p> My Chats </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('configration_access')
                <li class="nav-item has-treeview">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw nav-icon fas fa-user-tie"></i>
                            <p>
                                 Configuration
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                    <ul class="nav nav-treeview">
                        @can('counselor_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.counselors.index") }}" class="nav-link {{ request()->is("admin/counselors") || request()->is("admin/counselors/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-user-tie">
                                </i>
                                <p>
                                    {{ trans('cruds.counselor.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('tamhub_access')
                        <li class="nav-item has-treeview">
                        <a class="nav-link nav-dropdown-toggle" href="{{ route("admin.tamhubs.index") }}">
                            <i class="fa-fw nav-icon fas fa-users"></i>
                            <p>
                               {{ trans('cruds.tamhub.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                    <ul class="nav nav-treeview">
                        @can('library_accses')
                        <li class="nav-item">
                            <a href="{{ route("admin.librarys.index") }}" class="nav-link {{ request()->is("admin/librarys") || request()->is("admin/librarys/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-user-tie"></i>
                                <p>
                                    Library
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('tamhub_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.tamhubs.index") }}" class="nav-link {{ request()->is("admin/tamhubs") || request()->is("admin/tamhubs/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-user-tie"></i>
                                <p>
                                    Resource Center
                                </p>
                            </a>
                        </li>
                        @endcan
                       
                    </ul>
                    </li>
                        @endcan
                        @can('bookappointment_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.bookappointments.index") }}" class="nav-link {{ request()->is("admin/bookappointments") || request()->is("admin/bookappointments/*") ? "active" : "" }}">
                                    <i class="fa-fw nav-icon fas fa-user-tie"></i>
                                    <p>
                                        {{ trans('cruds.bookappointment.title') }}
                                    </p>
                                </a>
                            </li>
                        @endcan
                        @can('privacy_policy_accses')
                            <li class="nav-item">
                                <a href="{{ route("admin.privacypolicys.index") }}" class="nav-link {{ request()->is("admin/privacypolicys") || request()->is("admin/privacypolicys/*") ? "active" : "" }}">
                                    <i class="fa-fw nav-icon fas fa-user-tie"></i>
                                    <p>
                                        {{ trans('cruds.privacypolicy.title') }}
                                    </p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                    </li>
                @endcan
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
              
                @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                    @can('profile_password_edit')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                <i class="fa-fw fas fa-key nav-icon">
                                </i>
                                <p>
                                    {{ trans('global.change_password') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                @endif
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt nav-icon">

                            </i>
                            <p>{{ trans('global.logout') }}</p>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>