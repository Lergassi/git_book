@extends("layouts.main")

@section("content")
    <div class="block">
        <div class="block__title">Списки ваших книг</div>
        <div class="block__content">
            <table class="table">
                <thead>
                    <tr>
                        @foreach($columns as $column)
                            <th>{{$column}}</th>
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