@extends("layouts.main")

@section("content")
    <div class="block block_border-primary">
        <div class="block__title">
            Книга
        </div>
        <div class="block__content">
            <div class="block-simple">
                <a class="btn btn_primary" href="{{route("admin.chapter.edit", ["chapter" => $chapter->id])}}">Редактировать</a>
                <form class="block-inline" action="{{route("admin.chapter.destroy", ["chapter" => $chapter->id])}}" method="POST">
                    {{--TODO: Временное удаление. Сделать отдельную страницу.--}}
                    {{method_field("DELETE")}}
                    {{csrf_field()}}
                    <input class="btn btn_danger" type="submit" name="chapter[delete]" value="Удалить">
                </form>
            </div>
            <table class="table">
                @foreach($chapter->getAttributes() as $key => $value)
                    <tr>
                        <td>{{\App\Helper::trans("chapter." . $key)}}</td>
                        <td>{{$value}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection