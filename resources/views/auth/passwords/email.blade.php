@extends('layouts.login')

@section('content')

    @if (session('status'))
        <v-alert type="success" :value="true">
            {{ session('status') }}
        </v-alert>
    @endif
    <v-flex xs12 sm4 offset-sm4 class="mt-5">
        <v-card class="elevation-12">
            <v-toolbar dark color="primary">
                <v-toolbar-title>
                    {{ __('Reset Password') }}
                </v-toolbar-title>
                <v-spacer></v-spacer>
            </v-toolbar>

            <v-form method="POST" action="{{ route('password.email') }}">
                <v-card-text>
                    @csrf
                    <v-text-field
                            prepend-icon="person"
                            label="{{ __('E-Mail Address') }}"
                            name="email"
                            type="email"
                    ></v-text-field>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn dark color="primary" type="submit">
                            {{ __('Send Password Reset Link') }}
                        </v-btn>
                    </v-card-actions>
                </v-card-text>
            </v-form>
        </v-card>
    </v-flex>
@endsection