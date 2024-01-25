<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
</head>
<body>
    <h2>{{$userStatus}}: {{$userName}}</h3>
    <button id="logOutButton">Logout</button>
    <input type="hidden" name="logoutRoute" id="logoutRoute" value="{{route('logout')}}">
    <form method="POST" action="{{ route('requestForm') }}" id='sendRequestForm'>
        @csrf
        <input type="text" name="message" placeholder="Request" required>
        <button type="submit">Send</button>
        <a href="{{route('requestsView')}}">Все запросы</a>
    </form>
    <script src='{{asset("js/logout.js")}}'></script>    
</body>
</html>