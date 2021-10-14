@extends('app')

@section('content')
    <h2>{{ $user->name }}</h2>
    <h3>email: {{ $user->email }}</h3>
@endsection
