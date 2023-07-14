@extends('layouts.app')
@section('content')
    @include('layouts.header')
    <div class="container cart">
        <div class="level_container">
            <h1>Level 1</h1>
            <h2><img src="{{asset('storage/images/pokecoin.png')}}"> {{Auth::user()['poke_coins']}} PokéCoins</h2>
            <hr>
        </div>

        <h1>Order History</h1>
        <table class="table cart__table">
            <thead>
              <tr>
                <th scope="col">Item</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
              </tr>
            </thead>
            <tbody>
                @foreach($transaction_items as $transaction_item)
                    <tr>
                        <td>{{$transaction_item['name']}}</td>
                        <td>{{$transaction_item['quantity']}}</td>
                        <td>₱ {{number_format($transaction_item['money_price'] * $transaction_item['quantity'])}}.00</td>
                    </tr>
                @endforeach
            </tbody>
          </table>
    </div>

@endsection