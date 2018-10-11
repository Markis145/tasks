@extends('layouts.app')

@section('title')
    Sobre nosaltres
@endsection
@section('content')
    <h1>Sobre nosaltres</h1>
    Soc Marc Mestre Algueró, estudiant de DAM, pobre, calvo, gordo i damunt coixo. Ah, el meu gos es diu Jaky, aquí podeu veure unes quantes fotos d'ell.

    <v-card>
        <v-container grid-list-sm fluid>
            <v-layout row wrap>
                <v-flex
                        v-for="n in 9"
                        :key="n"
                        xs4
                        d-flex
                >
                    <v-card flat tile class="d-flex">
                        <v-img
                                :src="`https://lh3.googleusercontent.com/V2axi_NzL6OdeeNioTtKEZ62Utvwl8FINBE1z4SVuq4CcrR4UCgSaZbr2BxUTx8HjiuUlWTmrb9ffUMdNIsHygOoWeWVpL4gnPTG4cAlQn2qlEDnltiAE3Xsw2wkDOjJZ5-0NhSwFdCNJ-S2R_yYlvUFcG_COsPcQI9L5SII6R8zoQ13nWcBfOoq8CTPeAJEWOW2hx6jE8qIviuVR_GVwmh1N8zewcci1nP6mapPW0sPqjBOqFwO9C2_NHiWIz7n1PU4YeBkeNpsp2uJ9tyV4z8vUlKe-vMwqWc-5aMjbj1Fi4YYeNKNWv5HJeAESKQj7N7unxwwqk86yiIay0PVIZtV14CdzuPmo2kFgY73K5PAy8fpHObYVsaeJZqszyAxjJLirCdyFblsSlPpwkarpL1rgYalmp3TWSEAC-opEum94tb5aenvu54BogUuKiaw1k-NOc3d3QdTTXf2lO3JglAE5HZtmasPozf54B3eGauipXv6Ttlh_ooxksK0BtGxViYucROiCjJWvLJSr2_Q011GGvALwDd97-FYtgO2_ouOx3NyC5yLhlOKiFmUmVmhiO_r1TX0Ux4sVOg_vUem6Hhs54GHWPUGxd0Rhf3myRXU-UPRvUBkLKC_-6EYO9w=w726-h968-no`"
                                aspect-ratio="1"
                                class="grey lighten-2"
                        >
                            <v-layout
                                    slot="placeholder"
                                    fill-height
                                    align-center
                                    justify-center
                                    ma-0
                            >
                                <v-progress-circular indeterminate color="grey lighten-5"></v-progress-circular>
                            </v-layout>
                        </v-img>
                    </v-card>
@endsection