@component('mail::message')
    # Tasca modificada

    S'ha modificat la tasca: {{ $task->name }}

    @component('mail::button', ['url' => url('/tasques')])
        Veure tasca
    @endcomponent

    Gracies,<br>
    {{ config('app.name') }}
@endcomponent