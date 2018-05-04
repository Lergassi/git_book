@extends("layouts.main")

@section("content")
    <div class="block block_border-primary">
        <div class="block__title">
            Списки коммитов книги
        </div>
        <div class="block__content">
            <table class="table">
                <thead>
                    <tr>
                        @foreach($columns as $column)
                            <th>{{\App\Helper::trans("commit." . $column)}}</th>
                        @endforeach
                    </tr>
                </thead>
                @foreach($commits as $commit)
                    <tr>
                        <td><a href="{{route("commit.show", ["commit" => $commit->id])}}">{{$commit->id}}</a></td>
                        <td>{{$commit->created_at}}</td>
                        <td>{{$commit->is_head}}</td>
                        <td>
                            @foreach($commit->next as $nextCommit)
                                <span><a href="{{route("commit.show", ["commit" => $nextCommit->id])}}">{{$nextCommit->id}}</a></span>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection