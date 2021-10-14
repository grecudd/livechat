@extends('app')

@section('content')
    <form action="{{ route('chats.create') }}">
        <input type="submit" value="Create chat">
    </form>
    @if (count($chats) > 0)
        @foreach ($chats as $chat)
            <h3>
                <a href="{{ route('chats.show', $chat->id) }}">{{ $chat->name }}</a>
            </h3>
        @endforeach
    @else <h3>No chats</h3>
    @endif
@endsection
