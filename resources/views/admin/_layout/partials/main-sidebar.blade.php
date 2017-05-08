<!-- Main sidebar -->
<div class="sidebar sidebar-main">
    <div class="sidebar-content">

        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">
                    <li @if (Request::path() == 'admin') class="active" @endif>
                        <a href="/admin"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                    </li>
                    <li @if (Request::is('admin/app/users/*') || Request::path() == 'admin/app/users') class="active" @endif>
                        <a href="/admin/app/users"><i class="fa fa-users"></i> <span>App Users</span></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-building"></i> <span>Buildings</span></a>
                        <ul>
                            <li @if (Request::is('admin/buildings/*') || Request::path() == 'admin/buildings') class="active" @endif>
                                <a href="/admin/buildings"><i class="fa fa-building"></i> <span>View All</span></a>
                            </li>
                            <li @if (Request::is('admin/categories/*') || Request::path() == 'admin/categories') class="active" @endif>
                                <a href="/admin/categories"><i class="fa fa-list"></i> <span>Categories</span></a>
                            </li>
                            <li @if (Request::is('admin/statuses/*') || Request::path() == 'admin/statuses') class="active" @endif>
                                <a href="/admin/statuses"><i class="fa fa-list"></i> <span>Statuses</span></a>
                            </li>
                            <li @if (Request::is('admin/conditions/*') || Request::path() == 'admin/conditions') class="active" @endif>
                                <a href="/admin/conditions"><i class="fa fa-list"></i> <span>Conditions</span></a>
                            </li>
                        </ul>
                    </li>
                    <li @if (Request::path() == 'admin/recordings') class="active" @endif>
                        <a href="/admin/recordings"><i class="fa fa-mobile-phone"></i> <span>Recordings</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /main navigation -->

    </div>
</div>
<!-- /main sidebar -->
