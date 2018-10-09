@extends('layouts.app')

@section('content')
    <h1>Tasques</h1>
    {{--Laravel BLade--}}
    {{--{{ $tasks }}--}}
    <ul>
        @foreach ($tasks as $task)
            @if($task->completed)
                <li><del>{{ $task->name }}</del>

                    <form action="" method="POST">
                        @csrf
                        {{ method_field('PUT') }}
                        <input type="hidden" name="id" value="{{ $task->id  }}">
                        <button type="submit">Complete</button>
                    </form>

                    <a href="/task_edit/{{$task->id}}">
                        <button>Modificar</button>
                    </a>

                    <form action="/tasks/{{ $task->id }}" method="POST">
                        @csrf
                        {{ method_field('DELETE') }}
                        <button>Eliminar</button>
                    </form>
                </li>
            @else
                <li>{{ $task->name }}

                    <form action="" method="POST">
                        @csrf
                        {{ method_field('PUT') }}
                        <input type="hidden" name="id" value="{{ $task->id  }}">
                        <button type="submit">Complete</button>
                    </form>

                    <a href="/task_edit/{{$task->id}}">
                        <button>Modificar</button>
                    </a>
                    <form action="/tasks/{{ $task->id }}" method="POST">
                        @csrf
                        {{ method_field('DELETE') }}
                        <button>Eliminar</button>
                    </form>
                </li>
            @endif
        @endforeach
    </ul>

    <form action="/tasks" method="POST">
        @csrf
        <input name="name" type="text" placeholder="Nova tasca">
        <button>Afegir</button>
    </form>
    @endsection