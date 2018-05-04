@extends("admin.layouts.main")

@section("content")
    <div class="block block_border-primary">
        <div class="block__title">
            Создать книгу
        </div>
        <div class="block__content">
            <form action="{{route("book.store")}}" method="POST">
                {{csrf_field()}}
                <div class="input-group">
                    <label class="label" for="">{{\App\Helper::trans("book.title")}}</label>
                    <input class="input" type="text" name="book[title]" value="{{\App\Helper::value($book, "book.title")}}">
                </div>
                <div class="input-group">
                    <label class="label" for="">{{\App\Helper::trans("book.description")}}</label>
                    <textarea class="textarea" name="book[description]" cols="30" rows="10">{{\App\Helper::value($book, "book.description")}}</textarea>
                </div>
                <input class="btn btn_primary" type="submit" name="book[create]" value="Создать">
            </form>
        </div>
    </div>
@endsection