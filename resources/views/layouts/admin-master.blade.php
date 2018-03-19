<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin area</title>
    <link rel="stylesheet" href="{{ URL::to('css/admin.css') }}">
    @yield('styles')
</head>
<body>
    @include('includes.admin-header')
    @yield('content')

    <script type="text/javascript">
        var baseUrl = "{{ URL::to('/') }}";
    </script>
    @yield('scripts')
</body>
</html>