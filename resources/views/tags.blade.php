@extends('layouts.app')

@section('title')
    Tags en Vue
@endsection

@section('content')
    <v-container fluid>
        <v-layout>
            <v-flex>
                <tags :tasks="{{ $tags }}" ></tags>
            </v-flex>
        </v-layout>
    </v-container>
@endsection