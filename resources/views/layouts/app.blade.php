<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="/css/styles.css" rel="stylesheet">
    <link href="/datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/blog.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lity/2.2.2/lity.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};

    </script>
</head>
<body>
<div id="app">
@include('layouts.nav')

@yield('content')

<!-- Scripts -->

    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="/datetimepicker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    @yield('vue-mixins')
    @yield('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lity/2.2.2/lity.min.js"></script>
    <script>
        $(function () {
            $(".datepicker").datepicker({
                dateFormat: "dd/mm/yy"
            });
        });
        $(document.location.hash).click();
        window.setTimeout(function () {
            $("#save-message").fadeTo(500, 0).slideUp(500, function () {
                $(this).remove();
            });
        }, 2000);

        $('.timepicker').datetimepicker({
            format: 'dd/mm/yyyy hh:ii',
            startView: 1,
            minuteStep: 15,
            autoclose: true
        });
    </script>
</div>
</body>
</html>
