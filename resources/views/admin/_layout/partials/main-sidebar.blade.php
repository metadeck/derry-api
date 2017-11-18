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
                    <li @if (Request::is('admin/users/*') || Request::path() == 'admin/users') class="active" @endif>
                        <a href="/admin/users"><i class="fa fa-users"></i> <span>Users</span></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-building"></i> <span>Businesses</span></a>
                        <ul>
                            <li @if (Request::is('admin/businesses/*') || Request::path() == 'admin/businesses') class="active" @endif>
                                <a href="/admin/businesses"><i class="fa fa-building"></i> <span>View All</span></a>
                            </li>
                            <li @if (Request::is('admin/categories/*') || Request::path() == 'admin/categories') class="active" @endif>
                                <a href="/admin/categories"><i class="fa fa-list"></i> <span>Categories</span></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /main navigation -->

    </div>
</div>
<!-- /main sidebar -->
