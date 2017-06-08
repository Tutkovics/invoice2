@extends('layouts.master')

@section('title', 'Belépés')



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
            <h3><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Belépés</h3>
                {!! Form::open(array('route' => 'postLogin')) !!}
                    <div class="input-group">
                        <input name="email" type="text" class="form-control {{ $errors->has('email') ? 'has-error' : '' }}" placeholder="Email-cím" value="{{ Request::old('email') }}">
                    </div>
                        <br>
                    <div class="input-group">
                        <input name="password" type="password" class="form-control {{ $errors->has('password') ? 'has-error' : '' }}" placeholder="Jelszó">
                    </div>
                        <br>
                    <button type="submit" class="btn btn-primary">Belépés</button>
            {!! Form::close() !!}
        </div>

        <div class="col-sm-6 col-xs-12">
            <h3><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Regisztráció</h3>
            {!! Form::open(array('route' => 'postSignUp')) !!}
            <div class="input-group">
                <input style="width: 100%" name="nick" type="text" class="form-control {{ $errors->has('nick') ? 'has-error' : '' }}" placeholder="Beceneved" value="{{ Request::old('nick') }}">
            </div>
            <br>
            <div class="input-group">
                <input name="email" type="text" class="form-control {{ $errors->has('email') ? 'has-error' : '' }}" placeholder="Email-cím" value="{{ Request::old('email') }}">
            </div>
            <br>
            <div class="input-group">
                <input name="password" type="password" class="form-control {{ $errors->has('password') ? 'has-error' : '' }}" placeholder="Jelszó">
            </div>
            <br>
            <div class="input-group">
                <input name="again_password" type="password" class="form-control" placeholder="Jelszó újra">
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Regisztáció</button>
            {!! Form::close() !!}
        </div>
    </div>

@endsection