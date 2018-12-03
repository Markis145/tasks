@component('mail::message')
# Introduction

Hola {{ $user->name }},
correu de benvinguda a l'aplicació de Tasques.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
