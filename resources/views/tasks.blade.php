<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Tasqes</h1>
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
</body>
</html>