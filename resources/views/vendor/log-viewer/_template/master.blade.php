<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>日志管理</title>
    <meta name="description" content="LogViewer">
    <meta name="author" content="ARCANEDEV">
    <link rel="stylesheet" href="/common/log-viewer/bootstrap.min.css">
    <link rel="stylesheet" href="/common/log-viewer/font.css">
    <link rel="stylesheet" href="/common/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/common/log-viewer/bootstrap-datetimepicker.min.css">

    @include('log-viewer::_template.style')
    <!-- [if lt IE 9]> -->
    <!-- <script src="/common/log-viewer/html5shiv.min.js"></script>
    <script src="/common/log-viewer/respond.min.js"></script> -->
    <!-- [endif] -->
</head>
<body>
    @include('log-viewer::_template.navigation')

    <div class="container-fluid">
        @yield('content')
    </div>

    @include('log-viewer::_template.footer')

    <script src="/amaze/js/jquery.min.js"></script>
    <script src="/common/log-viewer/bootstrap.min.js"></script>
    <script src="/common/log-viewer/moment-with-locales.min.js"></script>
    <script src="/common/log-viewer/Chart.min.js"></script>
    <script src="/common/log-viewer/bootstrap-datetimepicker.min.js"></script>
    <script>
        Chart.defaults.global.responsive      = true;
        Chart.defaults.global.scaleFontFamily = "'Source Sans Pro'";
        Chart.defaults.global.animationEasing = "easeOutQuart";
    </script>
    @yield('scripts')
</body>
</html>
