@extends('layouts.master')

@section('title')
    Profilom
@endsection

@section('navbar')
    <ul class="nav nav-tabs" style="margin:10px 2px 0px 10px">
        <li role="presentation"><a href="{{ route('myBills') }}">Számláim</a></li>
        <li role="presentation"><a class="active" href="#">Profilom</a></li>
        <li role="presentation"><a href="{{ route('logout') }}">Kilépés</a></li>
    </ul>
@endsection

@section('content')
    <h1>Profilom</h1>
    <br>
        <div class="row login">
            <h3>
                <span class="glyphicon glyphicon-hand-down" aria-hidden="true"></span> Ezt tároljuk rólad
            </h3>

            @if (count($errors) > 0)
                <div class="row">
                    <div class="alert alert-danger center col-sm-6">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <div class="col-sm-6">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Név: </strong>{{ Auth::user()->nick }}</li>
                    <li class="list-group-item"><strong>Email: </strong>{{ Auth::user()->email }}</li>
                    <li class="list-group-item">
                        <a href="{{ url()->previous() }}">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Vissza
                        </a>
                    </li>
                </ul>

            </div>
            <div class="col-sm-6">

                <h3>Profilkép</h3>
                <div class="media">
                    <div class="media-left">
                        <a href="#">
                            {{--<img class="media-object img-responsive" style="max-width:400px" src="https://s-media-cache-ak0.pinimg.com/736x/d4/45/20/d4452035f501e05adf90c63af107bb1a.jpg" alt="...">--}}
                            <img class="media-object img-responsive" style="max-width:400px" src="{{route('picture.show') }}" alt="...">
                        </a>
                    </div>
                    <form action="{{ route('uploadProfilePicture') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="file" name="profilepicture">
                        <button type="submit">Mentés</button>
                    </form>
                </div>

            </div>
        </div>
@endsection