<!doctype html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">--}}
    <title>@yield('title')</title>
</head>
<body>
<v-app id="app">
    <v-navigation-drawer
            v-model="drawer"
            fixed
            app
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
        {{--<v-list dense>--}}
            {{--<v-list-tile href="/tasks">--}}
                {{--<v-list-tile-action>--}}
                    {{--<v-icon>assignment</v-icon>--}}
                {{--</v-list-tile-action>--}}
                {{--<v-list-tile-content>--}}
                    {{--<v-list-tile-title>Tasques en PHP</v-list-tile-title>--}}
                {{--</v-list-tile-content>--}}
            {{--</v-list-tile>--}}
            {{--<v-list-tile href="/tasks_vue">--}}
                {{--<v-list-tile-action>--}}
                    {{--<v-icon>assignment</v-icon>--}}
                {{--</v-list-tile-action>--}}
                {{--<v-list-tile-content>--}}
                    {{--<v-list-tile-title>Tasques en Vue</v-list-tile-title>--}}
                {{--</v-list-tile-content>--}}
            {{--</v-list-tile>--}}
            {{--<v-list-tile href="/about">--}}
                {{--<v-list-tile-action>--}}
                    {{--<v-icon>account_box</v-icon>--}}
                {{--</v-list-tile-action>--}}
                {{--<v-list-tile-content>--}}
                    {{--<v-list-tile-title>About</v-list-tile-title>--}}
                {{--</v-list-tile-content>--}}
            {{--</v-list-tile>--}}
            {{--<v-list-tile href="/contact">--}}
                {{--<v-list-tile-action>--}}
                    {{--<v-icon>person</v-icon>--}}
                {{--</v-list-tile-action>--}}
                {{--<v-list-tile-content>--}}
                    {{--<v-list-tile-title>Contact</v-list-tile-title>--}}
                {{--</v-list-tile-content>--}}
            {{--</v-list-tile>--}}
        {{--</v-list>--}}
    </v-navigation-drawer>
    <v-toolbar color="indigo" dark fixed app>
        <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
        <v-toolbar-title>Menú</v-toolbar-title>
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
    <v-footer color="indigo" app>
        <span class="white--text">Created by Marc Mestre Algueró, &copy; 2018 All rights reserved</span>
    </v-footer>
</v-app>

<script src="{{mix('js/app.js')}}"></script>
</body>
</html>