@extends('layouts.app')

@section('title')
    Tasques
@endsection

@section('content')
    <show-one-task :task="{{ json_encode($task) }}" :users="{{ $users }}"></show-one-task>
@endsection