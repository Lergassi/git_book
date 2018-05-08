@extends('layouts.main')

@section('content')
    <div class="col-50 col_center hello-block">
        @include("auth._login_form")
    </div>
@endsection
