@extends('layouts.master')

@section('title')
    {{ $bill->name }}
@endsection

@section('navbar')
    <ul class="nav nav-tabs" style="margin:10px 2px 0px 10px">
        <li role="presentation"><a href="{{ route('myBills') }}">Számláim</a></li>
        <li role="presentation"><a href="{{ route('showUser') }}">Profilom</a></li>
        <li role="presentation"><a href="{{URL::to('logout')}}">Kilépés</a></li>
    </ul>
@endsection

@section('content')
    <h1>{{ $bill->name }} <small> számla</small></h1>
    <br>
        <div class="row">
            <div class="col-sm-5">
                <h4> <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span> Számla kezelése</h4>
                <div class="list-group">
                    <a href="{{ URL::to('bill/'.$bill->id.'/spend') }}" class="list-group-item"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Új kiadás</a>
                    <a href="{{ URL::to('bill/'.$bill->id.'/income') }}" class="list-group-item"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Új bevétel</a>
                    <a href="{{ url()->previous() }}" class="list-group-item"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Vissza</a>

                </div><br>
                <div>
                    @include('graphs')
                </div>
            </div>

            <div class="col-sm-5 col-sm-offset-2">
                <h4> <span class="glyphicon glyphicon-header" aria-hidden="true"></span> Tranzakció history</h4>
                <div class="container-fluid list-group">
                @php $sum = 0; //count the current balance @endphp
                @foreach($bill->transactions as $transaction)
                        <div class=" list-group-item row
                            @if( !$transaction->income ) @php( $sum -= $transaction->amount) list-group-item-danger
                            @else @php( $sum += $transaction->amount) list-group-item-success
                            @endif ">
                            <div class="col-xs-5">
                                {{ $transaction->from }}
                            </div>
                            <div class="col-xs-3">
                            </div>
                            <div class="sum col-xs-3 text-right">
                                {{ $transaction->amount }}
                            </div>
                            <a href="{{ route('showTransaction', ['id' => $transaction->id ]) }}" class="col-xs-1"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                        </div>
                @endforeach
                </div>
                <p>Tranzakciók száma: {{ count($bill->transactions) }}</p>
            </div>
        </div>

    <br>
    <div class="panel @if($sum < 0) panel-danger @else panel-success @endif">
        <div class="panel-heading">Számlán van</div>
        <div class="panel-body row">
            <blockquote class="blockquote col-sm-9">
                <p class="mb-0">{{ $bill->description }}</p>
                <!-- maybe in the future footer class="blockquote-footer">{{ $bill->created_at }}</footer-->
            </blockquote>
            <h3 class="text-right col-sm-3"><strong>{{ $sum }} </strong></h3>
        </div>
    </div>

@endsection