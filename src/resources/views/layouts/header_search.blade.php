<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header_search.css') }}">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__outer">
            <div class="header__inner">
                <div class="header__sitetitle-wrapper">
                    @yield('header_hamburger')
                    <h1 class="header__sitetitle">Rese</h1>
                </div>
                @yield('header_func_search')
            </div>
        </div>
    </header>
    
    <main>
        @yield('content')
    </main>
</body>

</html>