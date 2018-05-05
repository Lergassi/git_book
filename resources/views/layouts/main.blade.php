<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>git_book - Пишем книги вместе!</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;subset=cyrillic">
    <link href="https://fonts.googleapis.com/css?family=Exo+2:300,400,600&amp;subset=cyrillic" rel="stylesheet">
    <link rel="stylesheet" href="{{asset($style)}}">
    @if (\Illuminate\Support\Facades\Request::is('admin', "admin/*"))
        {{--TODO: Параметры стилей в config.--}}
        <link rel="stylesheet" href="{{asset("/css/admin/adminlte.css")}}">
    @endif
</head>
<body>
    <div class="header-wrapper">
        <div class="header">
            <div class="header__logo">
                <a href="{{route("homepage")}}">git_book</a>
            </div>
            <ul class="menu">
                @foreach($menu as $menuItem)
                    <li class="menu__item"><a class="menu__link" href="{{route($menuItem["route"])}}">{{$menuItem["label"]}}</a></li>
                @endforeach
                @if(!\Illuminate\Support\Facades\Auth::guest())
                        <li class="menu__item"><a class="menu__link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ВЫХОД</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                @endif
            </ul>
        </div>
    </div>
    <div class="wrapper">
        @yield("left-sidebar")
        <div class="content @yield("content-class")">
            @section("errors")
                @if($errors->any())
                    <div class="block block_border-danger">
                        <div class="block__title">Ошибка!</div>
                        <div class="block__content">
                            @foreach($errors->all() as $error)
                                <ul>
                                    <li>{{$error}}</li>
                                </ul>
                            @endforeach
                        </div>
                    </div>
                @endif
            @show
            @yield("content")
        </div>{{--end content--}}
        @yield("right-sidebar")
    </div>{{--end wrapper--}}
    <div class="footer-wrapper">
        <div class="footer">
            <div class="footer-links">
                <a class="footer-links__item" href="#">О проекте</a>
                <a class="footer-links__item" href="https://vk.com" target="_blank">Вконтакте</a>
            </div>
        </div>
    </div>
</body>
</html>