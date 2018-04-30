@extends("layouts.main")

@section("content")
    {{--<div class="block block_border-primary">--}}
        {{--<div class="block__title">--}}
            {{--Главы книги--}}
        {{--</div>--}}
        {{--<div class="block__content">--}}
            {{--<table class="table">--}}
                {{--<thead>--}}
                    {{--<tr>--}}
                        {{--@foreach($columns as $column)--}}
                            {{--<th>{{$column}}</th>--}}
                    {{--@endforeach--}}
                    {{--</tr>--}}
                {{--</thead>--}}
                {{--@foreach($chapters as $chapter)--}}
                    {{--<tr>--}}
                        {{--<td><a href="{{route("chapter.show", ["chapter" => $chapter->id])}}">{{$chapter->title}}</a></td>--}}
                        {{--<td>{{$chapter->description}}</td>--}}
                        {{--<td>{{$chapter->created_at}}</td>--}}
                    {{--</tr>--}}
                {{--@endforeach--}}
            {{--</table>--}}
        {{--</div>--}}
    {{--</div>--}}
    @include("chapter._list")
@endsection