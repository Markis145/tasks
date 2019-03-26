@extends('layouts.chat')

@section('content')
    <chat :channels="{{ $channels }}" :user="{{ $user }}"></chat>
@endsection
