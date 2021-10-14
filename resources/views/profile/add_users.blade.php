@extends('app')

@section('content')
    <h1>Add users</h1>
    <form action="{{ route('chats.store_users') }}" method="POST">
        @csrf
        <label for="user_name">Name: </label>
        <input type="text" name="name_search">
        <input type="hidden" name="chat_id" value="{{ $chat->id }}">
        <input type="submit" value="Add">
    </form>
@endsection
