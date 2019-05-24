@extends('layouts.login')

@section('title')
    Reset Password
@endsection

@section('content')
    <v-container fluid fill-height>
        <v-layout align-center justify-center>
            <v-flex xs12 sm4>
                <v-card class="elevation-12">
                    <v-toolbar color="primary" dark>
                        <v-toolbar-title>{{ __('Restablir la contrasenya') }}</v-toolbar-title>
                    </v-toolbar>

                    <v-card-text>
                        <v-form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <v-text-field id="email" type="email"
                                          error-messages="{{ $errors->first('email') }}"
                                          class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                          name="email"
                                          value="{{ $email ?? old('email') }}" placeholder="{{ __('Correu Electrònic') }}"
                                          required
                                          autofocus>
                            </v-text-field>

                            <v-text-field id="password" type="password"
                                          error-messages="{{ $errors->first('password') }}"
                                          class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                          name="password" required placeholder="{{ __('Contrasenya') }}">

                            </v-text-field>

                            <v-text-field id="password-confirm" type="password" class="form-control"
                                          name="password_confirmation" required
                                          placeholder="{{ __('Confirmar Contrasenya') }}"></v-text-field>

                            <v-btn type="submit" class="primary">
                                {{ __('Reinicia Password') }}
                            </v-btn>

                        </v-form>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection
