@extends('layouts.app')

@section('title')
    Editar tasca
@endsection
@section('content')
<form action="/tasks/{{$task->id}}" method="POST">
    @csrf
    {{ method_field('PUT') }}
    Nom: <input name="name" type="text" value="{{$task->name}}">
    <v-btn color="info">
        <button>Editar</button>
    </v-btn>
</form>
@endsection