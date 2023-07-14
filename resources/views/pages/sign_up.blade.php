@extends('layouts.app')

@section('content')
    @include('layouts.sign_in_header')    
    <div class="container sign_in_wrapper">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error) 
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="/sign_up" class="sign_up">
            <h1 class="text-center">Sign Up</h1>
            @csrf
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input 
                    type="text"
                    class="form-control"
                    placeholder="Juan"
                    name="first_name"
                    required
                >
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input
                    type="text"
                    class="form-control"
                    placeholder="Dela Cruz"
                    name="last_name"
                    required
                >
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input
                type="email" 
                class="form-control"
                placeholder="example@email.com"
                name="email"
                required
            >
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input
                type="password"
                class="form-control"
                placeholder="*********"
                name="password"
                required
                >
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input
                    type="password"
                    class="form-control"
                    placeholder="*********"
                    name="password_confirmation"
                    required
                >
              </div>
            <button type="submit">Register</button>
            <div class="sign_up__register_container">
              <p>Already have an account? <a href="/login">Sign in</a></p>
            </div>
          </form>
    </div>
@endsection