@extends('layouts.app')

@section('title')
    Tasques en Vue
@endsection

@section('content')
    <v-container fluid>
        <v-layout>
            <v-flex>
                <tasques :tasks="{{ $tasks }}" :users="{{ $users }}"></tasques>
            </v-flex>
        </v-layout>
    </v-container>
@endsection