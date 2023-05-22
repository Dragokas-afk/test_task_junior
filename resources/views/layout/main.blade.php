<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/resources/css/app.css">
    <title>@yield('title')</title>
</head>
<body>
<header class="navbar">
    <div class="wrapper">
        <div class="logo">
            <h1 class="logo_text">Test Task Junior</h1>
        </div>
        @if(Auth::user()->isProvider())
            <div class="nav_menu">
                <a class="link" href="{{ route('reportProvider') }}">Отчет поставщика</a>
                <a class="link" href="{{ route('newEquipment') }}">Добавить новое оборудование</a>
            </div>
        @endif
        @if(Auth::user()->isManager())
            <div class="nav_menu">
                <a class="link" href="{{ route('reportManager') }}">Отчет управляющего</a>
                <a class="link" href="{{ route('replaceEquipment') }}">Переместить новое оборудование</a>
            </div>
        @endif

    </div>
</header>
<main class="container">
    @yield('content')
</main>
</body>
</html>
