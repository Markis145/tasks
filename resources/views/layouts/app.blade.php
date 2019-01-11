<!doctype html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user" content="{{ logged_user() }}">
    <meta name="git" content="{{ git() }}">
    <meta name="theme-color" content="#8719E0"/>
    <link rel="manifest" href="/manifest.json">
    <title>@yield('title')</title>
    <style>
        [v-cloak] {display: none}
    </style>
</head>
<body>
<v-app id="app" v-cloak>
    <snackbar></snackbar>
    <v-navigation-drawer
            v-model="drawer"
            fixed
            app
            clipped
    >
        <v-list dense>
            <template v-for="item in items">
                <v-layout
                        v-if="item.heading"
                        :key="item.heading"
                        row
                        align-center
                >
                    <v-flex xs6>
                        <v-subheader v-if="item.heading">
                            @{{ item.heading }}
                        </v-subheader>
                    </v-flex>
                    <v-flex xs6 class="text-xs-center">
                        <a href="#!" class="body-2 black--text">EDIT</a>
                    </v-flex>
                </v-layout>
                <v-list-group
                        v-else-if="item.children"
                        v-model="item.model"
                        :key="item.text"
                        :prepend-icon="item.model ? item.icon : item['icon-alt']"
                        append-icon=""
                >
                    <v-list-tile slot="activator" :href="item.url">
                        <v-list-tile-content>
                            <v-list-tile-title>
                                @{{ item.text }}
                            </v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile
                            v-for="(child, i) in item.children"
                            :key="i"
                            @click=""
                            :href="child.url"
                    >
                        <v-list-tile-action v-if="child.icon">
                            <v-icon>@{{ child.icon }}</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>
                                @{{ child.text }}
                            </v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list-group>
                <v-list-tile v-else :key="item.text" @click="" :href="item.url">
                    <v-list-tile-action>
                        <v-icon>@{{ item.icon }}</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>
                            @{{ item.text }}
                        </v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </template>
        </v-list>
    </v-navigation-drawer>
    <v-navigation-drawer
            v-model="drawerRight"
            fixed
            right
            clipped
            app
    >
        <v-card>
            <v-card-title class="secondary darken3 white--text"><h4>Perfil</h4></v-card-title>
            <v-layout row wrap>
                <v-flex xs12>
                        <p>Nom: {{ Auth::user()->name }}</p>
                        <p>Email: {{ Auth::user()->email }}</p>
                        @if(Auth::user()->admin)
                                Super Administrador
                        @else
                                Usuari
                        @endif
                        <p></p>
                        <p>Rols: {{ implode(',',Auth::user()->map()['roles']) }}</p>
                        <p>Permissos: {{ implode(', ',Auth::user()->map()['permissions']) }}</p>
                        <h3>Colors del tema</h3>
                        <color></color>
                </v-flex>
            </v-layout>
        </v-card>
        <v-card>
            <v-card-title class="secondary darken3 white--text"><h4>Opcions administrador</h4></v-card-title>

            <v-layout row wrap>
                @impersonating
                <v-flex xs12>
                    <v-avatar title="{{ Auth::user()->impersonatedBy()->name }} ( {{ Auth::user()->email }} )">
                        <img src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->impersonatedBy()->email) }}" alt="avatar">
                    </v-avatar>
                </v-flex>
                @endImpersonating
                <v-flex xs12>
                    @canImpersonate
                    <impersonate label="Entrar com..." url="/api/v1/regular_users"></impersonate>
                    @endCanImpersonate
                    @impersonating
                    {{ Auth::user()->impersonatedBy()->name }} està suplantant {{ Auth::user()->name }}
                    <a href="impersonate/leave">Abandonar la suplantació</a>
                    @endImpersonating
                </v-flex>
            </v-layout>
        </v-card>
    </v-navigation-drawer>
    <v-toolbar color="primary" dark fixed app clipped-right clipped-left>
        <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
        <v-toolbar-title>Menú</v-toolbar-title>
        <span v-role="'SuperAdmin'" style="margin-left: 2%"><git-info></git-info></span>
        <v-spacer></v-spacer>
        <h4 class="white-text mb-3 font-italic text-center" style="margin-top: 1%">{{ Auth::user()->email }}&nbsp;&nbsp;&nbsp;&nbsp;</h4>
        <v-avatar @click="drawerRight = !drawerRight" title="{{Auth::user()->name}}({{(Auth::user()->email)}})">
            <img src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}" alt="avatar">
        </v-avatar>
        <v-form action="logout" method="POST">
            @csrf
            <v-btn color="error" type="submit">Logout</v-btn>
        </v-form>
    </v-toolbar>
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

<script src="{{mix('js/app.js')}}"></script>
</body>
</html>