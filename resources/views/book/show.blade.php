@extends("layouts.main")

@section("content")
    <div class="block">
        <div class="block__title">Книга</div>
        <div class="block__content">
            <a href="{{route("book.edit", ["book" => $book->id])}}">Редактировать</a>
            <form action="{{route("book.destroy", ["book" => $book->id])}}" method="POST">
                {{--TODO: Временное удаление. Сделать отдельную страницу.--}}
                {{method_field("DELETE")}}
                {{csrf_field()}}
                <input type="submit" name="book[delete]" value="Удалить">
            </form>
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
@endsection