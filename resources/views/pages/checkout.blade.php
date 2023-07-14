@extends('layouts.app')
@section('content')
    @include('layouts.header')
    <div class="container">
        <div class="gcash">
            <form method="POST" action="/checkout" class="gcash__container">
                @csrf
                <div class="gcash__header">
                    <h1>Merchant: Pokemon Store</h1>
                    <h1>Amount Due: ₱ {{$price}}.00</h1>
                </div>
                <div class="gcash__body">
                    <h1>Login to pay with Gcash</h1>
                    <p>Input your mobile number</p>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                        <div class="input-group-text">+63</div>
                        </div>
                        <input type="text" class="form-control">
                        <input type="hidden" name="item_id" value="{{ request()->id }}">
                    </div>
                </div>
                <div class="gcash__footer">
                    <button type="submit" class="gcash__footer__button">Pay</button>
                </div>
            </form>
        </div>
    </div>

@endsection