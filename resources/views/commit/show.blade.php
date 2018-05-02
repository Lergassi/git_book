@extends("layouts.main")

@section("content")
    <div class="block block_border-primary">
        <div class="block__title">
            Книга
        </div>
        <div class="block__content">
            <div class="block-simple">
                <form class="block-inline" action="{{route("commit.checkout", ["commit" => $commit->id])}}" method="POST">
                    {{csrf_field()}}
                    <input class="btn btn_danger" type="submit" name="commit[checkout]" value="checkout">
                </form>
            </div>
            <table class="table">
                @foreach($commit->getAttributes() as $key => $value)
                    <tr>
                        <td>{{\App\Helper::trans("book." . $key)}}</td>
                        <td>{{$value}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection