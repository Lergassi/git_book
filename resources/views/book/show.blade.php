@extends("layouts.main")

@section("content")
    <div class="block block_border-primary">
        <div class="block__title">
            Книга
        </div>
        <div class="block__content">
            <div class="block-simple">
                <a class="btn btn_primary" href="{{route("chapter.create", ["book" => $book->id])}}">Добавить главу</a>
                <a class="btn btn_primary" href="{{route("book.edit", ["book" => $book->id])}}">Редактировать</a>
                <form class="block-inline" action="{{route("book.destroy", ["book" => $book->id])}}" method="POST">
                    {{--TODO: Временное удаление. Сделать отдельную страницу.--}}
                    {{method_field("DELETE")}}
                    {{csrf_field()}}
                    <input class="btn btn_danger" type="submit" name="book[delete]" value="Удалить">
                </form>
                <form class="block-inline" action="{{route("commit.create", ["book" => $book->id])}}" method="POST">
                    {{--{{method_field("PUT")}}--}}
                    {{csrf_field()}}
                    <input class="btn btn_warning" type="submit" name="book[delete]" value="Commit">
                </form>
                <a class="btn btn_primary" href="{{route("commit.index", ["book" => $book->id])}}">Версии</a>
            </div>
            <table class="table">
                @foreach($book->getAttributes() as $key => $value)
                    <tr>
                        <td>{{\App\Helper::trans("book." . $key)}}</td>
                        <td>{{$value}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    @include("chapter._list", [
            "columns" => [
                "id",
                "title",
                "next_chapter_id",
                "created_at",
                ],
            "chapters" => $book->chapters
            ])
@endsection