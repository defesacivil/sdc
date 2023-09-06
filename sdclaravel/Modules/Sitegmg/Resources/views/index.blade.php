@extends('sitegmg::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('sitegmg.name') !!}
    </p>
@endsection
