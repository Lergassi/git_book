@extends("admin.layouts.main")

@section("content")
    <form action="{{route("admin.chapter.update", ["chapter" => $chapter->id])}}" method="POST">
        <div class="block block_border-primary">
            <div class="block__title">
                Редактировать книгу
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
                <input class="btn btn_primary" type="submit" name="chapter[save]" value="Сохранить">
                <a class="btn" href="{{route("admin.chapter.show", ["chapter" => $chapter->id])}}">Отмена</a>
            </div>
        </div>
    </form>
@endsection