@extends("layouts.main")

@include("chapter._menu")

@section("content")
    <div class="block block_border-primary">
        <div class="block__title">
            Глава
        </div>
        <div class="block__content">
            <div class="block-simple">
                <a class="btn btn_primary" href="{{route("chapter.edit", ["chapter" => $chapter->id])}}">Редактировать</a>
                <form class="block-inline" action="{{route("chapter.destroy", ["chapter" => $chapter->id])}}" method="POST">
                    {{--TODO: Временное удаление. Сделать отдельную страницу.--}}
                    {{method_field("DELETE")}}
                    {{csrf_field()}}
                    <input class="btn btn_danger" type="submit" name="chapter[delete]" value="Удалить">
                </form>
            </div>
            <table class="table">
                    <tr>
                        <td>{{\App\Helper::trans("chapter.title")}}</td>
                        <td>{{$chapter->title}}</td>
                    </tr>
                    <tr>
                        <td>{{\App\Helper::trans("chapter.text")}}</td>
                        <td>{{$chapter->text}}</td>
                    </tr>
                    <tr>
                        <td>{{\App\Helper::trans("chapter.created_at")}}</td>
                        <td>{{$chapter->created_at}}</td>
                    </tr>
                    <tr>
                        <td>{{\App\Helper::trans("chapter.updated_at")}}</td>
                        <td>{{$chapter->updated_at}}</td>
                    </tr>
            </table>
        </div>
    </div>
@endsection