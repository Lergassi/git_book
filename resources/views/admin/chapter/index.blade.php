@extends("admin.layouts.main")

@section("content")
    <div class="block block_border-primary">
        <div class="block__title">
            Список глав
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
                @foreach($chapters as $chapter)
                    <tr>
                        <td>{{$chapter->id}}</td>
                        <td><a href="{{route("admin.chapter.show", ["chapter" => $chapter->id])}}">{{$chapter->title}}</a></td>
                        <td>{{$chapter->created_at}}</td>
                        <td>{{$chapter->book_id}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection