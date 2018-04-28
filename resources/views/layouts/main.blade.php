<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;subset=cyrillic">
    <link rel="stylesheet" href="{{asset("/css/main.css")}}">
</head>
<body>
    <div class="header-wrapper">
        <div class="header">
            <div class="header__logo">LOGO</div>
            <ul class="menu">
                @foreach($menu as $menuItem)
                    <li class="menu__item"><a class="menu__link" href="{{route($menuItem["route"])}}">{{$menuItem["label"]}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="wrapper">
        <div class="content">
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
            @yield("content")
        </div>
    </div>
</body>
</html>