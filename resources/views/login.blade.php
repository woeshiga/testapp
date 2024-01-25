<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
</head>
<body>
    <a href="{{route('homeView')}}">На главную</a>
    <form class="loginForm" method="POST" action="{{ route('login') }}">
        @csrf
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button class='loginButton' type="submit">Войти</button>
    </form>
</body>
</html>