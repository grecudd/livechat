@extends('app')

@section('content')
    @if ($error)
        <div class="alert alert-dismissable">
            {{ $error }}
        </div>
    @endif

    <h2>{{ $chat->name }}</h2>
    @if (Auth::user()->id == $chat->user_id)
        <button>
            <a href="{{ route('chats.add_users', $chat->id) }}">Add users</a>
        </button>

        <form action="{{ route('chats.destroy', $chat->id) }}" method="POST">
            @method('DELETE')
            @csrf
            <button type="submit">Delete</button>
        </form>
    @endif

    <h4>
        @foreach ($chat->users as $user)
            @if ($user->id == $chat->user_id)
                Admin: {{ $user->name }} <br>
            @else
                {{ $user->name }}
            @endif
        @endforeach
        <br>
    </h4>


    @foreach ($chat->messages as $message)
        <h3>
            <a href="{{ route('profile', $message->user_id) }}">{{ $message->username }}</a>:
            {{ $message->message }}
            <br>
        </h3>
    @endforeach

    <form action="{{ route('sendMessage', $chat->id) }}" method="POST">
        @csrf
        <label for="msg">Message :</label>
        <br>
        <textarea name="msg" rows="10" cols="30"></textarea>
        <br>
        <input type="submit" value="Send">
    </form>
@endsection
