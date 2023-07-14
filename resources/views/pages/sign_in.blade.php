@extends('layouts.app')

@section('content')
    @include('layouts.sign_in_header')
    <div class="container sign_in_wrapper">    
      <form method="post" action="/login" class="sign_in">
        <h1 class="text-center">Sign In</h1>
        @csrf
        <div class="form-group">
          <label for="email">Email</label>
          <input
            type="email"
            class="form-control"
            placeholder="example@email.com"
            name="email"
            required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input
            type="password"
            class="form-control"
            placeholder="*********"
            name="password"
            required>
        </div>
        <button>Login</button>
        <div class="sign_in__register_container">
          <p>Don't have an account? <a href="/sign_up">Sign up</a></p>
        </div>
      </form>
    </div>
@endsection