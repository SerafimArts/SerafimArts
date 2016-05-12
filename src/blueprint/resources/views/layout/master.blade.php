<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <title>{{ $title }} @section('title') @show</title>
    <link rel="stylesheet" type="text/css" href="{{ route('bp.asset', ['file' => 'admin.css']) }}" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
</head>
<body>
    @yield('content')
</body>
</html>