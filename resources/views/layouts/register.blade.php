<!doctype html>
<html lang="en">
<head>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    {{--<link rel="manifest" href="/site.webmanifest">--}}
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#8719E0">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#8719E0"/>
    <meta property="og:image" content="/img/branding.png">
    <meta property="og:image:width" content="279">
    <meta property="og:image:height" content="279">
    <meta name="vapidPublicKey" content="{{ config('webpush.vapid.public_key') }}">
    <meta property="og:description" content="Projecte de tasques per a 2&ordm; DAM de Marc Mestre Alguer&oacute;">
    <meta property="og:title" content="Tasques Marc Mestre Alguer&oacute;">
    <meta property="og:url" content="https://tasks.marcmestre.scool.cat">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@markis145" />
    <meta name="twitter:creator" content="@markis145" />
    <meta name="Description" content="App">
    <title>@yield('title')</title>
    <style>
        [v-cloak] {display: none}
    </style>
</head>
<body>
<div id="app" v-cloak>
    <v-app>
        @yield('content')
    </v-app>
</div>
<script defer src="{{mix('js/manifest.js')}}"></script>
<script defer src="{{mix('js/vendor.js')}}"></script>
<script defer src="{{mix('js/app.js')}}"></script>
</body>
</html>