@extends('layouts.master')

@section('title', 'Számláim')

@section('navbar')
    <ul class="nav nav-tabs" style="margin:10px 2px 0px 10px">
            <li role="presentation" class="active"><a href="#" >Számláim</a></li>
            <li role="presentation"><a href="{{ route('showUser') }}">Profilom</a></li>
            <li role="presentation"><a href="{{URL::to('logout')}}">Kilépés</a></li>
    </ul>
@endsection


@section('content')
    <div class="container">
       <h1><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Számláim</h1>
        <a href="{{ URL::to('addNewBill') }}" >
            <h3 class="text-right" style="color:#333;" ><!--onMouseOver="this.style.textdecoration='none'"
                onMouseOut="this.style.textdecoration='none'"--> <span style="color:#333" class="glyphicon glyphicon-plus" aria-hidden="true"></span> Új számla</h3>
        </a>

       <div class="list-group">
           @foreach( $bills as $bill )

               @php $sum = 0; //count the current balance @endphp
               @foreach($bill->transactions as $trans)
                   @if( $trans->income )
                       @php( $sum += $trans->amount)
                   @elseif( !$trans->income )
                       @php( $sum -= $trans->amount)
                   @endif
               @endforeach

               <a href="{{ route('getBill', ['id' => $bill->id]) }}" class="row list-group-item
                    @if($sum < 0) list-group-item-danger
                    @else list-group-item-success
                    @endif ">
                   <div class="col-xs-8">
                       {{ $bill->name }}
                   </div>
                   <div class=" col-xs-2">
                        {{ $sum }}
                   </div>

                   <div class=" col-xs-1">
                       <button class="btn btn-danger" onclick="location.href = '{{ route('deleteBill', ['bill' => $bill->id]) }}'">
                           <span style="color:#333" class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                       </button>
                   </div>
                </a>
           @endforeach
       </div>
    <p>Számlák száma: {{ count($bills) }}</p>
    </div>
@endsection