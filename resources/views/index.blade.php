<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <title>Worlds to be conquered... | Infinite Conflict</title>
    <meta name="description" content="The best online tick based strategy game">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="//fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/2.5.94/css/materialdesignicons.min.css">

    <!-- Styles -->
    @if (in_array(env('APP_ENV'), ['production', 'stage']))
        <link href="{{ mix('css/app.prod.css') }}" rel="stylesheet">
    @else
        <link href="{{ mix('css/app.dev.css') }}" rel="stylesheet">
    @endif

</head>
<body>
    <div id="app">
        <router-view></router-view>
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/manifest.js') }}"></script>
    @if (in_array(env('APP_ENV'), ['production', 'stage']))
        <script src="{{ mix('js/vendor.prod.js') }}"></script>
        <script src="{{ mix('js/app.prod.js') }}"></script>
    @else
        <script src="{{ mix('js/vendor.dev.js') }}"></script>
        <script src="{{ mix('js/app.dev.js') }}"></script>
    @endif
</body>
</html>
