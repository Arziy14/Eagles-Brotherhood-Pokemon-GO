@extends('layouts.app')
@section('content')
    @include('layouts.header')
    
    <h1 class="item_title">Order Review</h1>
    
    <div class="level_container">
        <h1>Level 1</h1>
        <h2><img src="{{asset('storage/images/pokecoin.png')}}"> {{$user['poke_coins']}} PokéCoins</h2>
    </div>
    <div class="item_purchase">
        <div class="image_container">
            <img src="{{asset($item['img_path'])}}">
        </div>
        <div class="item_purchase__details">
            <b class="item_purchase__name">{{$item['name']}}</b>
            <hr>
            <p class="item_purchase__price">₱ {{number_format($item['money_price'])}}.00</p>
            
        </div>
    </div>

    <div class="button_container">
        <button
            class="button_container__left_button"
            onclick="window.location.href='/home'">
            Back To Store
        </button>

        <form method="post" action="/item/addToCart/{{ $item['id'] }}">
            @csrf
            <input
                type="hidden"
                name="item_id"
                value="{{ $item['id'] }}"
            >
            <button
                type="submit"
                class="button_container__right_button">
                Add to cart
            </button>
        </form>
    </div>
@endsection