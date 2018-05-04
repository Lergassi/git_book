@section("content-class", "content_width-left-sidebar")

@section("left-sidebar")
    <div class="sidebar">
        <div class="block block_full-title-info">
            <div class="block__title">Главы</div>
            <div class="block__content block__content_unpadding">
                <ul class="sidemenu">
                    @foreach($chapter->book->chapters as $chapterItem)
                        <li class="sidemenu__item"><a class="sidemenu__link" href="{{route("chapter.show", ["chapter" => $chapterItem->id])}}">{{$chapterItem->title}}</a></li>
                    @endforeach

                        <li class="sidemenu__separator">Меню</li>
                        <li class="sidemenu__item"><a class="sidemenu__link" href="{{route("book.show", ["book" => $chapter->book->id])}}">К книге</a></li>
                        <li class="sidemenu__item"><a class="sidemenu__link" href="{{route("chapter.create", ["book" => $chapter->book->id])}}">Новая глава</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection