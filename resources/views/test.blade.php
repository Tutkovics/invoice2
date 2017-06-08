@extends('layouts.master')

@section('title', 'Test')

@section('content')
    <form method="POST" action="/profile">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

    </form>

    XSRF-TOKEN Cookie: {{  Cookie::get('XSRF-TOKEN') }}<br>
@endsection