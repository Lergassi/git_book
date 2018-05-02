@extends("layouts.main")

@section("content")
    <div class="block block_border-primary">
        <div class="block__title">
            Создать главу
        </div>
        <div class="block__content">
            <form action="{{route("chapter.store")}}" method="POST">
                {{csrf_field()}}
                <div class="input-group">
                    <label class="label" for="">{{\App\Helper::trans("chapter.title")}}</label>
                    <input class="input" type="text" name="chapter[title]" value="{{\App\Helper::value($chapter, "chapter.title")}}">
                </div>
                <div class="input-group">
                    <label class="label" for="">{{\App\Helper::trans("chapter.text")}}</label>
                    <textarea class="textarea" name="chapter[text]" cols="30" rows="10">{{\App\Helper::value($chapter, "chapter.text")}}</textarea>
                </div>
                <input type="hidden" name="chapter[book_id]" value="{{$chapter->book_id}}">
                <input class="btn btn_primary" type="submit" name="chapter[create]" value="Создать">
            </form>
        </div>
    </div>
@endsection