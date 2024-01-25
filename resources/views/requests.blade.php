<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
</head>
<body>
    <a href="{{route('homeView')}}">На главную</a>
    <table>
    <tr>
        <th>
            id
        </th>
        <th>
            name
        </th>
        <th>
            email
        </th>
        <th>
            status
        </th>
        <th>
            message
        </th>
        <th>
            comment
        </th>
        <th>
            created_at
        </th>
        <th>
            updated_at
        </th>
    </tr>
    @foreach($users as $user) 
        <tr>
            <td>{{$user['id']}}</td>
            <td>{{$user['name']}}</td>
            <td>{{$user['email']}}</td>
            <td>{{$user['status']}}</td>
            <td>{{$user['message']}}</td>
            <td>{{$user['comment']}}</td>
            <td>{{$user['created_at']}}</td>
            <td>{{$user['updated_at']}}</td>
            @if ($isAdmin) 
                <td>
                    <input type="hidden" name="responseRoute" value="{{route('resolve', $user['id'])}}" id="{{$user['id']}}">
                    <input type="text" placeholder="Comment..." id="c{{$user['id']}}">
                    <button id="sendTo{{$user['id']}}" class='sendResponseButton'>Send</button>
                </td>
            @endif
        </tr>
    @endforeach
    </table>
    <script src="{{asset('js/sendResponse.js')}}"></script>
</body>
</html>