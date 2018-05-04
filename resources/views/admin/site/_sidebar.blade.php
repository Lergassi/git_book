@section("sidebar")
    <div class="sidebar">
        <div class="block block_full-title-info">
            <div class="block__title">Меню</div>
            <div class="block__content block__content_unpadding">
                <ul class="sidemenu">
                    <li class="sidemenu__item"><a class="sidemenu__link" href="{{route("admin.book.index")}}">Книги</a></li>
                    <li class="sidemenu__item"><a class="sidemenu__link" href="{{route("admin.chapter.index")}}">Главы</a></li>
                </ul>
            </div>
        </div>
    </div>
@show