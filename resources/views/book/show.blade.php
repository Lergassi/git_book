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
                <a class="btn btn_primary" href="{{route("chapter.show", ["book" => $book->id])}}">Сортировка</a>
                <a class="btn btn_primary" href="{{route("commit.index", ["book" => $book->id])}}">Версии</a>
                <form class="block-inline" action="{{route("commit.create", ["book" => $book->id])}}" method="POST">
                    {{csrf_field()}}
                    <input class="btn btn_warning" type="submit" name="book[delete]" value="Запомнить версию">
                </form>
                @if($book->author_id != \Illuminate\Support\Facades\Auth::user()->id)
                    <form class="block-inline" action="{{route("commit.fork", ["book" => $book->id])}}" method="POST">
                        {{csrf_field()}}
                        <input class="btn btn_warning" type="submit" name="book[delete]" value="Копия книги">
                    </form>
                @endif
                <form class="block-inline" action="{{route("book.destroy", ["book" => $book->id])}}" method="POST">
                    {{--TODO: Временное удаление. Сделать отдельную страницу.--}}
                    {{method_field("DELETE")}}
                    {{csrf_field()}}
                    <input class="btn btn_danger" type="submit" name="book[delete]" value="Удалить">
                </form>
            </div>
            <table class="table">
                <tr>
                    <td>{{\App\Helper::trans("book.title")}}</td>
                    <td>{{$book->title}}</td>
                </tr>
                <tr>
                    <td>{{\App\Helper::trans("book.description")}}</td>
                    <td>{{$book->description}}</td>
                </tr>
                <tr>
                    <td>{{\App\Helper::trans("book.created_at")}}</td>
                    <td>{{$book->created_at}}</td>
                </tr>
                <tr>
                    <td>{{\App\Helper::trans("book.author_id")}}</td>
                    <td>{{$book->author_id}}</td>
                </tr>
                <tr>
                    <td>Главы</td>
                    <td>
                    @if($book->chapters()->count())
                        <a href="{{route("chapter.show", ["chapter" => $book->chapters()->first()->id])}}">Список</a>
                    @else
                        Глав нет. <a href="{{route("chapter.create", ["book" => $book->id])}}">Создать первую главу?</a>
                    @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection