<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<div class="auth-container">
    <h2>Login</h2>
    @if (Session::has('fail'))
        <span class="alert alert-danger">{{ Session::get('fail') }}</span>
    @endif
    <form action="{{ route('login') }}" method="POST">

        @csrf
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <a href="{{ route('register') }}">Don't have an account? Register</a>
</div>
</body>
</html>
