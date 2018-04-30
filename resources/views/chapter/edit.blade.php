@extends("layouts.main")

@section("content")
    <form action="{{route("chapter.update", ["chapter" => $chapter->id])}}" method="POST">
        <div class="block block_border-primary">
            <div class="block__title">
                Редактировать главу
            </div>
            <div class="block__content">
                {{csrf_field()}}
                {{method_field("PUT")}}
                <div class="input-group">
                    <label class="label" for="">{{\App\Helper::trans("chapter.title")}}</label>
                    <input class="input" type="text" name="chapter[title]" value="{{\App\Helper::value($chapter, "chapter.title")}}">
                </div>
                <div class="input-group">
                    <label class="label" for="">{{\App\Helper::trans("chapter.text")}}</label>
                    <textarea class="textarea" name="chapter[text]" cols="30" rows="10">{{\App\Helper::value($chapter, "chapter.text")}}</textarea>
                </div>
                <div class="input-group">
                    <label class="label" for="">{{\App\Helper::trans("chapter.next_chapter_id")}}</label>
                    <select class="select" name="chapter[next_chapter_id]" id="">
{{--                        {{$chapter->book->id}}--}}
                        <option value=""></option>
                        @foreach($chapter->book->chapters as $bookChapter)
                            <option value="{{$bookChapter->id}}" {{$chapter->next_chapter_id == $bookChapter->id ? "selected" : ""}}>{{$bookChapter->title}}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" name="chapter[book_id]" value="{{$chapter->book_id}}">
                <input class="btn btn_primary" type="submit" name="chapter[create]" value="Сохранить">
                <a class="btn" href="{{route("chapter.show", ["chapter" => $chapter->id])}}">Отмена</a>
            </div>
        </div>
    </form>
@endsection