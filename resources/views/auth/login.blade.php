@extends('layouts.app')
@section('content')
    <div class="form-group">
        <label for="login">Login</label>
        <input type="text" id="login" placeholder="Enter your login">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" placeholder="Enter your password">
    </div>
    <button class="button" id="login-button">Login</button>
@endsection
