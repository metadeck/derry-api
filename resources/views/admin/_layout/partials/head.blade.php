<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>

    <!-- Global stylesheets -->
    <link href="//fonts.googleapis.com/css?family=Ubuntu:400,500,700" rel="stylesheet">
    <link href="/limitless/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="/limitless/css/icons/fontawesome/styles.min.css" rel="stylesheet" type="text/css">
    <link href="/limitless/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="/limitless/css/core.css" rel="stylesheet" type="text/css">
    <link href="/limitless/css/components.css" rel="stylesheet" type="text/css">
    <link href="/limitless/css/colors.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="/limitless/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="/limitless/js/core/libraries/bootstrap.min.js"></script>
    <!-- /core JS files -->

    <!-- Plugin JS files -->
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC4ZTbHEKi0ncPIqDupUi40YngnhmGfijY"></script>

    <script type="text/javascript" src="/limitless/js/plugins/forms/styling/uniform.min.js"></script>
    <script type="text/javascript" src="/limitless/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
    <script type="text/javascript" src="/limitless/js/plugins/editors/summernote/summernote.min.js"></script>
    <script type="text/javascript" src="/limitless/js/plugins/notifications/jgrowl.min.js"></script>
    <script type="text/javascript" src="/limitless/js/plugins/notifications/sweet_alert.min.js"></script>
    <script type="text/javascript" src="/limitless/js/plugins/ui/dragula.min.js"></script>

    <script type="text/javascript" src="/limitless/js/core/libraries/jquery_ui/full.min.js"></script>
    <script type="text/javascript" src="/limitless/js/plugins/sliders/slider_pips.min.js"></script>
    <script type="text/javascript" src="/limitless/js/plugins/forms/styling/switchery.min.js"></script>
    <script type="text/javascript" src="/limitless/js/plugins/forms/styling/switch.min.js"></script>

    <script type="text/javascript" src="/limitless/js/plugins/notifications/pnotify.min.js"></script>

    <script type="text/javascript" src="/limitless/js/plugins/visualization/d3/d3.min.js"></script>
    <script type="text/javascript" src="/limitless/js/plugins/visualization/d3/d3_tooltip.js"></script>

    <script type="text/javascript" src="/limitless/js/core/app.js"></script>
    <!-- /theme JS files -->

    <!-- Handy Variables Scripts -->
    <script>
        window.Limitless = <?php echo json_encode([
            'csrfToken' => csrf_token()
        ]); ?>
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Vue file loaded at bottom of body-->
</head>