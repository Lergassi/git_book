@extends("layouts.main")

@section("content")
    <div class="block block_border-primary">
        <div class="block__title">
            Список ваших книг
        </div>
        <div class="block__content">
            <table class="table">
                <thead>
                    <tr>
                        @foreach($columns as $column)
                            <th>{{\App\Helper::trans("book." . $column)}}</th>
                    @endforeach
                    </tr>
                </thead>
                @foreach($books as $book)
                    <tr>
                        <td><a href="{{route("book.show", ["book" => $book->id])}}">{{$book->title}}</a></td>
                        <td>{{$book->description}}</td>
                        <td>{{$book->created_at}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection