@extends('layouts.master')

@section('title', 'Új számla')

@section('navbar')
    <ul class="nav nav-tabs">
        <li role="presentation"><a href="{{ route('myBills') }}">Számláim</a></li>
        <li role="presentation"><a href="{{ route('showUser') }}">Profilom</a></li>
        <li role="presentation"><a href="{{URL::to('logout')}}">Kilépés</a></li>
    </ul>
@endsection

@section('content')
    @if (count($errors) > 0)
        <div class="row">
            <div class="alert alert-danger center">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="row login" >
        <div class="col-sm-6 ">
            <h3><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Új számla nyitása</h3>
            {!! Form::open(array('route' => 'postNewBill')) !!}
            <div class="input-group">
                <input name="name" type="text" class="form-control {{ $errors->has('from') ? 'has-error' : '' }}" placeholder="Mi legyen a neve" value="{{ Request::old('name') }}">
            </div><br>
            <div class="input-group">
                <input name="description" type="text" class="form-control {{ $errors->has('description') ? 'has-error' : '' }}" placeholder="Mire fogod használni" value="{{ Request::old('description') }}">
            </div><br>
            <button type="submit" class="btn btn-primary">Mentés</button>
            {!! Form::close() !!}
        </div>

    </div>
@endsection