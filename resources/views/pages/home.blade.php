@extends('layouts.app')
@section('content')
    @include('layouts.header')
    <div class="container">
        <div class="home__banner_container">
            <img src="{{asset('storage/images/home-banner.png')}}" alt="Banner">
            <div class="home__banner_description">
                <h1 class="display-2">Get extra PokéCoins and find exclusive deals at the Pokémon Go Web Store!</h1>
            </div>
        </div>
    
        <div class="item_container">
            @foreach($items as $item)
                <div class="item">
                    <div class="image_container">
                        <img src="{{asset($item['img_path'])}}">
                    </div>
                    <div class="item__details">
                        <b class="item__name">{{$item['name']}}</b><br>
                        <b class="item__description">{{$item['description']}}</b>
                        <p class="item__price">₱ {{number_format($item['money_price'])}}.00</p>
                        
                        <button 
                            onclick="window.location.href='/item/{{$item['id']}}'">
                            Buy
                        </button>
                    </div>
                </div>
            @endforeach 
        </div>
    </div>

@endsection