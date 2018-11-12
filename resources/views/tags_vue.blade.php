@extends('layouts.app')

@section('title')
    Tags en Vue
@endsection

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    {{--<tasks :tasks="{{ $tasks }}"></tasks>--}}
    <tags></tags>
@endsection
