<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LiveChat</title>
</head>

<body>
    <h3>
        <a href="{{ route('chats.index') }}">Home /</a>
        User: {{ Auth::user()->name }} /
        <a href="{{ route('logOut') }}">LogOut</a>
        <br><br>
        <a href="{{ url()->previous() }}">Go back</a>
    </h3>
    @yield('content')
</body>

</html>
