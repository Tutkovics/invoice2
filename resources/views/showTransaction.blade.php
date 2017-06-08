@extends('layouts.master')

@section('title', 'Tranzakció módosítása')

@section('navbar')
    <ul class="nav nav-tabs">
        <li role="presentation"><a href="{{ route('myBills') }}">Számláim</a></li>
        <li role="presentation"><a href="{{ route('showUser') }}">Profilom</a></li>
        <li role="presentation"><a href="{{ route('logout') }}">Kilépés</a></li>
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
            <h3><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Tranzakció</h3>
            {!! Form::open(array('route' => ['editTransaction', $transaction->id] )) !!}
            <div class="input-group">
                <label>Kitől/kinek</label>
                <input name="from" type="text" class="form-control {{ $errors->has('from') ? 'has-error' : '' }}" value="{{ $transaction->from }}">
            </div><br>
            <div class="input-group">
                <label>Mennyit</label>
                <input name="amount" type="number" class="form-control {{ $errors->has('amount') ? 'has-error' : '' }}" value="{{ $transaction->amount }}">
            </div><br>
            <div class="input-group">
                <label>Leírás</label>
                <input name="description" type="text" class="form-control {{ $errors->has('description') ? 'has-error' : '' }}" value="{{ $transaction->description }}">
            </div><br>
            <div class="input-group">
                <label>Kiadás/bevétel</label>
                @php /*
                <input name="income" title="pipa->bevétel" type="checkbox" class="form-control {{ $errors->has('income') ? 'has-error' : '' }}" value="{{ $transaction->income }}" @if( $transaction->income) checked @endif>
                */@endphp
                <select class="form-control" name="income" id="income">
                    <option value="1" selected>Bevétel</option>
                    <option value="0" @if( !$transaction->income) selected @endif>Kiadás</option>
                </select>

            </div><br>
            <div class="input-group">
                <label>Tag</label>
                <select name ="tag" class="form-control">
                    @foreach( $tags as $tag)
                        <option value="{{ $tag->name }}" @if( $transaction->tag = $tag->name) selected @endif>{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div><br>
            <button class="btn btn-warning" onclick="goBack()">Vissza</button>
            <!--a href="{{ route('deleteTransaction',['transaction' => $transaction->id]) }}">
                <button onclick="location.href = '{{ route('deleteTransaction',['transaction' => $transaction->id]) }}'" class="btn btn-danger">Töröl</button>
            </a-->

            <button type="submit" class="btn btn-primary">Mentés</button>
            {!! Form::close() !!}
            <br>
            <a href="{{route('deleteTransaction', ['transaction' => $transaction->id])}}">
                <button class="btn btn-danger">Töröl</button>
            </a>
        </div>
     </div>
@endsection