@extends('layouts.master')

@section('title', 'Üdv')

@section('navbar')
    <ul class="nav nav-pills" style="margin:10px 2px 0px 10px">

        @if( null !== Auth::user())
            <li role="presentation" class="active"><a href="#">Welcome</a></li>
            <li role="presentation"><a href="{{ route('myBills') }}">Számláim</a></li>
            <li role="presentation"><a href="{{ route('showUser') }}">Profilom</a></li>
            <li role="presentation"><a href="{{ route('logout') }}">Kilépés</a></li>
        @else
            <li role="presentation" class="active"><a href="{{ route('auth') }}">Belépés</a></li>
            <li role="presentation"><a href="http://bunti.sch.bme.hu/">Büntipontot?</a></li>
        @endif

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

    <div class="container" style="height:80%;padding-top:100px;" >
        <div class="row vertical-center-row">
            <h1 class="display-1 text-center ">Üdv az oldalon te retkes fasz</h1>
        </div>
    </div>

@endsection