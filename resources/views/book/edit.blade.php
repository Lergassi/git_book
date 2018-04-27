@extends("layouts.main")

@section("content")
    <form action="{{route("book.update", ["book" => $book->id])}}" method="POST">
        {{csrf_field()}}
        {{method_field("PUT")}}
        <div class="input-group">
            <label class="label" for="">{{\App\Helper::trans("book.title")}}</label>
            <input type="text" name="book[title]" value="{{\App\Helper::value($book, "book.title")}}">
        </div>
        <div class="input-group">
            <label class="label" for="">{{\App\Helper::trans("book.description")}}</label>
            <textarea name="book[description]" cols="30" rows="10">{{\App\Helper::value($book, "book.description")}}</textarea>
        </div>
        <input type="submit" name="book[create]" value="Сохранить">
    </form>
@endsection