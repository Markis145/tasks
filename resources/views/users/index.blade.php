@extends('layouts.app')

@section('content')
    <users-list :users="{{ $users }}"></users-list>
@endsection