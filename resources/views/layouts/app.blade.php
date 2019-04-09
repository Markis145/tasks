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
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="vapidPublicKey" content="{{ config('webpush.vapid.public_key') }}">
    <meta name="user" content="{{ logged_user() }}">
    <meta name="git" content="{{ git() }}">
    <meta name="theme-color" content="#8719E0"/>
    <meta property="og:image" content="/img/branding.png">
    <meta property="og:image:width" content="279">
    <meta property="og:image:height" content="279">
    <meta property="og:description" content="Projecte de tasques per a 2&ordm; DAM de Marc Mestre Alguer&oacute;">
    <meta property="og:title" content="Tasques Marc Mestre Alguer&oacute;">
    <meta property="og:url" content="https://tasks.marcmestre.scool.cat">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@markis145" />
    <meta name="twitter:creator" content="@markis145" />
    <meta name="Description" content="App">
    <meta name="impersonatedBy" content="{{ Auth::user()->impersonatedBy() }}">
    <link rel="manifest" href="/manifest.json">
    <title>@yield('title')</title>
    <style>
        [v-cloak] {display: none}
    </style>
</head>
<body>
<noscript>
    <style>
        #enable-js {
            margin: 0;
            padding: 12px 15px;
            background-color: #FFC107;
            color: #000;
            text-align: center;
            font-family: "Arial";
            font-size: 13px;
        }
    </style>
    <p id="enable-js">No podeu utilitzar aquesta aplicació sense activar Javascript. <a target="_blank" href="https://www.enable-javascript.com/es/">Activeu Javascript per tal de millorar la vostra experiència d'usuari</a>.</p>
</noscript>
<v-app id="app" v-cloak style="background: #F0F4F8;background: -webkit-linear-gradient(to right, #F0F4F8, #D9E2EC, #BCCCDC);
              background: linear-gradient(to right, #F0F4F8, #D9E2EC, #BCCCDC);">
    <snackbar></snackbar>
    <share-fab></share-fab>
    <service-worker></service-worker>
    <navigation v-model="drawer"></navigation>
    <main-toolbar @toggle-right="drawerRight=!drawerRight"
                  @toggle-left="drawer=!drawer"
                  csrf-token="{{ csrf_token() }}">
    </main-toolbar>
    <navigation-right v-model="drawerRight"></navigation-right>

    <v-content>
        <v-container fluid fill-height>
            <v-layout
                    justify-center

            >
                <v-flex text-xs-center>
                    @yield('content')
                </v-flex>
            </v-layout>
        </v-container>
    </v-content>
    <v-footer color="primary" app>
        <span class="white--text">Created by Marc Mestre Algueró, &copy; 2018 All rights reserved</span>
    </v-footer>
</v-app>

<script defer src="{{mix('js/manifest.js')}}"></script>
<script defer src="{{mix('js/vendor.js')}}"></script>
<script defer src="{{mix('js/app.js')}}"></script>
</body>
</html>
