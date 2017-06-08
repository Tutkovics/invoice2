@extends('layouts.master')

@section('title', 'Új kiadás')

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
            <h3><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Kiadás</h3>
            {!! Form::open(array('url' => '/bill/'.$bill_id.'/spend')) !!}
            <div class="input-group">
                <input name="from" type="text" class="form-control {{ $errors->has('from') ? 'has-error' : '' }}" placeholder="Kinek" value="{{ Request::old('from') }}">
            </div><br>
            <div class="input-group">
                <input name="amount" type="number" class="form-control {{ $errors->has('amount') ? 'has-error' : '' }}" placeholder="Mennyit" value="{{ Request::old('amount') }}">
            </div><br>
            <div class="input-group">
                <input name="description" type="text" class="form-control {{ $errors->has('description') ? 'has-error' : '' }}" placeholder="Mire" value="{{ Request::old('description') }}">
            </div><br>
            <div class="input-group">
                <select name ="tag" class="form-control">
                    @foreach( $tags as $tag)
                        <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div><br>
            <button type="submit" class="btn btn-primary">Mentés</button>
            {!! Form::close() !!}
        </div>

    </div>
@endsection