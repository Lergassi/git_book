@extends("layouts.main")

@section("content")
    @if(\Illuminate\Support\Facades\Auth::guest())
        <div class="col-50 col_center hello-block">
            @include("auth._login_form")
        </div>
    @endif
@endsection
