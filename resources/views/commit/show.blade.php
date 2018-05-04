@extends("layouts.main")

@section("content")
    <div class="block block_border-primary">
        <div class="block__title">
            Книга
        </div>
        <div class="block__content">
            <div class="block-simple">
                <a class="btn btn_primary" href="{{route("book.show", ["book" => $commit->book->id])}}">К книге</a>
                <form class="block-inline" action="{{route("commit.checkout", ["commit" => $commit->id])}}" method="POST">
                    {{csrf_field()}}
                    <input class="btn btn_danger" type="submit" name="commit[checkout]" value="Восстановить">
                </form>
            </div>
            <table class="table">
                @foreach($commit->getAttributes() as $key => $value)
                    <tr>
                        <td>{{\App\Helper::trans("commit." . $key)}}</td>
                        <td>{{$value}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection