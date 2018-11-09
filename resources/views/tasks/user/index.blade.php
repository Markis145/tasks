@extends('layouts.app')

@section('content')
    {{ $tasks }}
    <tasques :tasks="{{ $tasks }}"></tasques>
@endsection
