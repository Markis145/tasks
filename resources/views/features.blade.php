@extends('layouts.app')

@section('title')
    Mobile features
@endsection

@section('content')
    <div>
        <div><vibrate></vibrate></div>
        {{--<div id="target"><geolocation></geolocation></div>--}}
        <div><geolocation></geolocation></div>
        <div><battery></battery></div>
        <div><online-status></online-status></div>
        <div><network></network></div>
        <div><memory></memory></div>
        <div><screen-orientation></screen-orientation></div>
    </div>
@endsection