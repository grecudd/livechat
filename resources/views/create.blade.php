@extends('app')

@section('content')

    <form action="{{ route('chats.store') }}" method="POST">
        @csrf
        <label for="roomName">Room name :</label>
        <input type="text" id="roomName" name="roomName"><br><br>
        <br>
        <input type="submit" value="Create">
    </form>

@endsection
