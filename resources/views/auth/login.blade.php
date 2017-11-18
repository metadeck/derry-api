<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>

    <!-- Global stylesheets -->
    <link href="//fonts.googleapis.com/css?family=Ubuntu:400,500,700" rel="stylesheet">
    <link href="/limitless/css/icons/fontawesome/styles.min.css" rel="stylesheet" type="text/css">
    <link href="/limitless/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="/limitless/css/core.css" rel="stylesheet" type="text/css">
    <link href="/limitless/css/components.css" rel="stylesheet" type="text/css">
    <link href="/limitless/css/colors.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="/limitless/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="/limitless/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="/limitless/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="/limitless/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="/limitless/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="/limitless/js/plugins/forms/inputs/typeahead/handlebars.min.js"></script>
    <script type="text/javascript" src="/limitless/js/plugins/forms/inputs/alpaca/alpaca.min.js"></script>
    <script type="text/javascript" src="/limitless/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js"></script>
    <script type="text/javascript" src="/limitless/js/plugins/forms/styling/switchery.min.js"></script>



    <script type="text/javascript" src="/limitless/js/core/app.js"></script>
    <!-- /theme JS files -->

</head>

<body class="login-container bg-gray-base">

<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content">

                <!-- Simple login form -->
                <form method="post" action="{{ url('/login') }}">
                    {{ csrf_field() }}

                    <div class="panel panel-body login-form border-radius-base">
                        <div class="text-center">
                            <h5 class="content-group text-gray-dark text-semibold">Sign in to the {{ config('app.name') }}</h5>
                        </div>

                        <div class="form-group has-feedback has-feedback-left">
                            <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" autofocus>
                            <div class="form-control-feedback">
                                <i class="fa fa-user text-muted"></i>
                            </div>
                        </div>

                        <div class="form-group has-feedback has-feedback-left">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                            <div class="form-control-feedback">
                                <i class="fa fa-lock text-muted"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                        </div>

                        <div class="text-center text-muted text-mini">
                            {{--  <p>Forgot your password? <a href="{{ url('/password/reset') }}">Recover them here</a></p>  --}}
                            {{--  <p>Don't have an account? <a href="#">Sign up now</a></p>  --}}
                        </div>
                    </div>
                </form>
                <!-- /simple login form -->


                <!-- Footer -->
                <div class="footer text-muted text-center text-mini">
                    &copy;<?php echo date("Y"); ?>  {{ config('app.name') }}. All Rights Reserved.
                </div>
                <!-- /footer -->

            </div>
            <!-- /content area -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->

</body>
</html>