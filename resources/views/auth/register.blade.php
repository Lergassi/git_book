@extends('layouts.main')

@section('content')
    <div class="col-50 col_center hello-block">
        @include("auth._register_form")
    </div>
@endsection
