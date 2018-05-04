@extends("admin.layouts.main")

@section("content")
    <form action="{{route("admin.book.update", ["book" => $book->id])}}" method="POST">
        <div class="block block_border-primary">
            <div class="block__title">
                Редактировать книгу
            </div>
            <div class="block__content">
                {{csrf_field()}}
                {{method_field("PUT")}}
                <div class="input-group">
                    <label class="label" for="">{{\App\Helper::trans("book.title")}}</label>
                    <input class="input" type="text" name="book[title]" value="{{\App\Helper::value($book, "book.title")}}">
                </div>
                <div class="input-group">
                    <label class="label" for="">{{\App\Helper::trans("book.description")}}</label>
                    <textarea class="textarea" name="book[description]" cols="30" rows="10">{{\App\Helper::value($book, "book.description")}}</textarea>
                </div>
                <input class="btn btn_primary" type="submit" name="book[create]" value="Сохранить">
                <a class="btn" href="{{route("admin.book.show", ["book" => $book->id])}}">Отмена</a>
            </div>
        </div>
    </form>
@endsection