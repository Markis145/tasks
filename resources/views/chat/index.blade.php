@extends('layouts.app')

@section('content')
    <chat :channels="{{ $channels }}" :user="{{ $user }}"></chat>
@endsection
