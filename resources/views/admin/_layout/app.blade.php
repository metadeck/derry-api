<!DOCTYPE html>
<html lang="en">

@include('admin._layout.partials.head')

    <body class="club-theme-default">

        <div id="app">

            <!-- Nav container -->
            @include('admin._layout.partials.main-nav')

            <!-- Page container -->
            <div class="page-container">

                <!-- Page content -->
                <div class="page-content">

                    <!-- Sidebar container -->
                @include('admin._layout.partials.main-sidebar')

                <!-- Main content -->
                @yield('content')
                <!-- /main content -->

                </div>
                <!-- /page content -->

            </div>
            <!-- /page container -->

        </div>
        <!-- /app container -->

        <!-- Vue App Bootstrap -->
        <script type="text/javascript" src="/js/app.js"></script>
        <!-- /Vue app Bootstrap -->

    </body>
</html>