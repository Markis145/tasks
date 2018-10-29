@extends('layouts.login')
@section('title')
    Login a l'aplicació de tasks
@endsection

@section('content')
    <v-content>
        <v-app id="inspire">
            <v-content>
                <v-container fluid fill-height>
                    <v-layout align-center justify-center>
                        <v-flex xs12 sm8 md4>
                            <v-card class="elevation-12">
                                <v-toolbar dark color="primary">
                                    <v-toolbar-title>Login form</v-toolbar-title>
                                </v-toolbar>
                                <v-card-text>
                                    <v-form action="/login">
                                        <v-text-field prepend-icon="person" name="login" label="Login" type="text"></v-text-field>
                                        <v-text-field id="password" prepend-icon="lock" name="password" label="Password" type="password"></v-text-field>
                                    </v-form>
                                </v-card-text>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn color="primary">Login</v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-content>
        </v-app>
    </v-content>
@endsection