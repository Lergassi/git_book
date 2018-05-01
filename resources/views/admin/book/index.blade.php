@extends("layouts.main")

@section("content")
    <div class="block block_border-primary">
        <div class="block__title">
            Список книг
        </div>
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
                        <td>{{$book->id}}</td>
                        <td><a href="{{route("admin.book.show", ["book" => $book->id])}}">{{$book->title}}</a></td>
                        <td>{{$book->created_at}}</td>
                        <td>{{$book->author_id}}</td>
                        <td>@if($book->headCommit()){{$book->headCommit()->id}}@endif</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection