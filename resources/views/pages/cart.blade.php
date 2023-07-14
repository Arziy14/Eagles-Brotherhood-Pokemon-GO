@extends('layouts.app')
@section('content')
    @include('layouts.header')
    <div class="container cart">
        <div class="level_container">
            <h1>Level 1</h1>
            <h2><img src="{{asset('storage/images/pokecoin.png')}}"> {{$user['poke_coins']}} PokéCoins</h2>
            <hr>
        </div>

        <h1>Cart Items</h1>
        <table class="table cart__table">
            <thead>
              <tr>
                <th scope="col">Item</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach($cart_items as $cart_item)
                    <tr>
                        <td><a href="/item/{{$cart_item['id']}}">{{ $cart_item['name']}}</a></td>
                        <td>{{$cart_item['quantity']}}</td>
                        <td>₱ {{number_format($cart_item['money_price'] * $cart_item['quantity'])}}.00</td>
                        <td>
                            <form class="d-inline" method="post" action="/item/addToCart/{{ $cart_item['id'] }}">
                                @csrf
                                <input
                                    type="hidden"
                                    name="item_id"
                                    value="{{ $cart_item['id'] }}"
                                >
                                <button type="submit" class="btn btn-warning m-1"><b>+</b></button>
                            </form>
                            <form class="d-inline" method="post" action="/item/deleteFromCart/{{ $cart_item['id'] }}">
                                @csrf
                                <input
                                    type="hidden"
                                    name="item_id"
                                    value="{{ $cart_item['id'] }}"
                                >
                                <button type="submit" class="btn btn-danger"><b>-</b></button>
                            </form>
                            <button
                                class="btn btn-success"
                                onclick="window.location.href='/checkout/{{$cart_item['id']}}'">
                                Purchase
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
    </div>

@endsection