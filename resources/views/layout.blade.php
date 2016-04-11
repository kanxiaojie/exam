<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>教学系统</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/libs.css">
</head>
<body>
    @include('partials.page-nav')

    <div class="container">
        @yield('content')
    </div>

    <script src="/js/libs.js"></script>

    <script>
        $('#my-table').dynatable();
        $('#my-table2').dynatable();
    </script>

    @yield('scripts')
    @include('flash')
</body>
</html>