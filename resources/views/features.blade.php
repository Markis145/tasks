@extends('layouts.app')

@section('title')
    Mobile features
@endsection

@section('content')
    <div>
        <vibrate></vibrate>
        {{--<div id="target"><geolocation></geolocation></div>--}}
        <geolocation></geolocation>

    </div>
@endsection