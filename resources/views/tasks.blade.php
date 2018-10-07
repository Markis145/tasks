<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact</title>
</head>
<body>

<div id="app">
    <v-app>
        <v-navigation-drawer
                v-model="drawer"
                fixed
                app
        >
            <v-list dense>
                <v-list-tile href="/tasks">
                    <v-list-tile-action>
                        <v-icon>home</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Tasques</v-list-tile-title>
                    </v-list-tile-content>
                    <v-list-tile href="/contact">
                        <v-list-tile-action>
                            <v-icon>person</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>Contact</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile href="/about">
                        <v-list-tile-action>
                            <v-icon>info</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>About</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
            </v-list>
        </v-navigation-drawer>
        <v-toolbar color="indigo" dark fixed app>
            <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
            <v-toolbar-title>Php-learning</v-toolbar-title>
        </v-toolbar>
        <v-content>
            <v-container fluid fill-height>
                <v-layout
                        justify-center
                >
                    <v-flex text-xs-center>

<v-card>
    <v-toolbar color="cyan" dark>
        <v-toolbar-side-icon></v-toolbar-side-icon>

        <v-toolbar-title>Tasques</v-toolbar-title>

        <v-spacer></v-spacer>

        <v-btn icon>
            <v-icon>search</v-icon>
        </v-btn>
    </v-toolbar>

    <v-list two-line>
        <v-subheader>
            Tasques
        </v-subheader>

        <v-divider></v-divider>
        <form action="/tasks" method="POST">
            @csrf
            <input name="name" type="text" placeholder="Nova tasca">
            <button>Afegir</button>
        </form>

        <?php foreach ($tasks as $task) : ?>

        <v-list-tile>

            <v-list-tile-avatar>
                <img src="https://placeimg.com/100/100/any">
            </v-list-tile-avatar>

            <v-list-tile-content>
                <v-list-tile-title>
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
                </v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>
        <?php endforeach;?>
    </v-list>
</v-card>


                    </v-flex>
                </v-layout>
            </v-container>
        </v-content>
        <v-footer color="indigo" app>
            <span class="white--text"> Created by Marc Mestre Algueró &copy;2018 All rights reserved</span>
        </v-footer>
    </v-app>
</div>

<footer></footer>

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.js"></script>
<script>
    new Vue({
        el: '#app' ,
        data: () => ({
            drawer: null
        }),
        props: {
            source: String
        }})
</script>
</body>
</html>