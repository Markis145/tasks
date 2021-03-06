@extends('layouts.app')

@section('content')

<h1>Contact</h1>
<template>
    <v-layout justify-center>
        <v-flex xs12 sm10 md8 lg6>
            <v-card ref="form">
                <v-card-text>
                    <v-text-field
                            ref="name"
                            v-model="name"
                            :rules="[() => !!name || 'This field is required']"
                            :error-messages="errorMessages"
                            label="Full Name"
                            placeholder="John Doe"
                            required
                    ></v-text-field>
                    <v-text-field
                            ref="address"
                            :rules="[
              () => !!address || 'This field is required',
              () => !!address && address.length <= 25 || 'Address must be less than 25 characters',
              addressCheck
            ]"
                            v-model="address"
                            label="Address Line"
                            placeholder="Snowy Rock Pl"
                            counter="25"
                            required
                    ></v-text-field>
                    <v-text-field
                            ref="city"
                            :rules="[() => !!city || 'This field is required', addressCheck]"
                            v-model="city"
                            label="City"
                            placeholder="El Paso"
                            required
                    ></v-text-field>
                    <v-text-field
                            ref="state"
                            v-model="state"
                            :rules="[() => !!state || 'This field is required']"
                            label="State/Province/Region"
                            required
                            placeholder="TX"
                    ></v-text-field>
                    <v-text-field
                            ref="zip"
                            :rules="[() => !!zip || 'This field is required']"
                            v-model="zip"
                            label="ZIP / Postal Code"
                            required
                            placeholder="79938"
                    ></v-text-field>
                    <v-autocomplete
                            ref="country"
                            :rules="[() => !!country || 'This field is required']"
                            :items="countries"
                            v-model="country"
                            label="Country"
                            placeholder="Select..."
                            required
                    ></v-autocomplete>
                </v-card-text>
                <v-divider class="mt-5"></v-divider>
                <v-card-actions>
                    <v-btn flat>Cancel</v-btn>
                    <v-spacer></v-spacer>
                    <v-slide-x-reverse-transition>
                        <v-tooltip
                                v-if="formHasErrors"
                                left
                        >
                            <v-btn
                                    slot="activator"
                                    icon
                                    class="my-0"
                                    @click="resetForm"
                            >
                                <v-icon>refresh</v-icon>
                            </v-btn>
                            <span>Refresh form</span>
                        </v-tooltip>
                    </v-slide-x-reverse-transition>
                    <v-btn color="primary" flat @click="submit">Submit</v-btn>
                </v-card-actions>
            </v-card>
        </v-flex>
    </v-layout>
</template>


@endsection