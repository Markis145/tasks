@extends('layouts.landing')

@section('title')
    Welcome
@endsection

@section('content')
    <v-app light>
        <v-toolbar class="white">
            <v-toolbar-title>Marc Mestre Algueró</v-toolbar-title>
            <v-spacer></v-spacer>
            @if (Route::has('login'))
                    @auth
                        <v-btn href="{{ url('/home') }}">Home</v-btn>
                    @else
                        <v-btn href="{{ route('login') }}">Login</v-btn>
                        <v-btn href="{{ route('register') }}">Register</v-btn>
                    @endauth
            @endif
        </v-toolbar>
        <v-content>
            <section>
                <v-parallax-webp src="img/inici.webp" height="600" class="article" alt-format="jpg">
                    <v-layout
                            column
                            align-center
                            justify-center
                            class="white--text"
                    >
                        <img-webp src="img/branding.webp" alt="Tasques" height="200" alt-format="png">
                        <h1 class="mb-2 display-1 text-xs-center font-weight-black" id="fgoogle" style=" font-family: 'Montserrat', sans-serif; text-shadow: black 0.1em 0.1em 0.1em">Aplicació Tasques Marc Mestre</h1>
                        <div class="subheading mb-3 text-xs-center font-weight-bold" id="fgoogle" style=" font-family: 'Montserrat', sans-serif; text-shadow: black 0.1em 0.1em 0.1em">Fet amb vuetify</div>
                        <v-layout>
                            <v-btn
                                    class="primary lighten-2 mt-5"
                                    dark
                                    large
                                    href="/home"
                            >
                                Get Started
                            </v-btn>
                            <v-btn depressed
                                   class="dark mt-5"
                                   target="_blank"
                                   large
                                   href="https://github.com/Markis145/tasks"
                            ><img src="img/github.png" alt="Github" height="25" class="mr-3">
                                Github
                            </v-btn>
                        </v-layout>
                    </v-layout>
                </v-parallax-webp>
            </section>

            <section>
                <v-layout
                        column
                        wrap
                        class="my-5"
                        align-center
                >
                    <v-flex xs12 sm4 class="my-3">
                        <div class="text-xs-center">
                            <h2 class="headline">La teva aplicació de tasques preferida</h2>
                            <span class="subheading">
                Comença ara a gestionar les teves tasques diaries
              </span>
                        </div>
                    </v-flex>
                    <v-flex xs12>
                        <v-container grid-list-xl>
                            <v-layout row wrap align-center>
                                <v-flex xs12 md4>
                                    <v-card class="elevation-0 transparent">
                                        <v-card-text class="text-xs-center">
                                            <v-icon x-large class="blue--text text--lighten-2">color_lens</v-icon>
                                        </v-card-text>
                                        <v-card-title primary-title class="layout justify-center">
                                            <div class="headline text-xs-center">Material Design</div>
                                        </v-card-title>
                                        <v-card-text>
                                            Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare.
                                            Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                                            Nullam in aliquet odio. Aliquam eu est vitae tellus bibendum tincidunt. Suspendisse potenti.
                                        </v-card-text>
                                    </v-card>
                                </v-flex>
                                <v-flex xs12 md4>
                                    <v-card class="elevation-0 transparent">
                                        <v-card-text class="text-xs-center">
                                            <v-icon x-large class="blue--text text--lighten-2">flash_on</v-icon>
                                        </v-card-text>
                                        <v-card-title primary-title class="layout justify-center">
                                            <div class="headline">Fast development</div>
                                        </v-card-title>
                                        <v-card-text>
                                            Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare.
                                            Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                                            Nullam in aliquet odio. Aliquam eu est vitae tellus bibendum tincidunt. Suspendisse potenti.
                                        </v-card-text>
                                    </v-card>
                                </v-flex>
                                <v-flex xs12 md4>
                                    <v-card class="elevation-0 transparent">
                                        <v-card-text class="text-xs-center">
                                            <v-icon x-large class="blue--text text--lighten-2">build</v-icon>
                                        </v-card-text>
                                        <v-card-title primary-title class="layout justify-center">
                                            <div class="headline text-xs-center">Completely Open Sourced</div>
                                        </v-card-title>
                                        <v-card-text>
                                            Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare.
                                            Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                                            Nullam in aliquet odio. Aliquam eu est vitae tellus bibendum tincidunt. Suspendisse potenti.
                                        </v-card-text>
                                    </v-card>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-flex>
                </v-layout>
            </section>

            <section>
                <v-parallax-webp src="img/inici2.webp" height="380" alt-format="jpg">
                    <v-layout column align-center justify-center>
                        <div class="headline white--text mb-3 text-xs-center">Organitzar la teva vida mai havia sigut tant facil</div>
                        <em>Comença avui a fer-ho</em>
                        <v-btn
                                class="primary lighten-2 mt-5"
                                dark
                                large
                                href="/home"
                        >
                            Get Started
                        </v-btn>
                    </v-layout>
                </v-parallax-webp>
            </section>

            <section>
                <v-container grid-list-xl>
                    <v-layout row wrap justify-center class="my-5">
                        <v-flex xs12 sm4>
                            <v-card class="elevation-0 transparent">
                                <v-card-title primary-title class="layout justify-center">
                                    <div class="headline">Company info</div>
                                </v-card-title>
                                <v-card-text>
                                    Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare.
                                    Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                                    Nullam in aliquet odio. Aliquam eu est vitae tellus bibendum tincidunt. Suspendisse potenti.
                                </v-card-text>
                            </v-card>
                        </v-flex>
                        <v-flex xs12 sm4 offset-sm1>
                            <v-card class="elevation-0 transparent">
                                <v-card-title primary-title class="layout justify-center">
                                    <div class="headline">Contacta amb nosaltres</div>
                                </v-card-title>
                                <v-card-text>
                                    Si tens algun dubte, pregunta o formes part d'alguna empresa que voldria col·laborar amb nosaltres, simplement contacta.
                                </v-card-text>
                                <v-list class="transparent">
                                    <v-list-tile>
                                        <v-list-tile-action>
                                            <v-icon class="blue--text text--lighten-2">phone</v-icon>
                                        </v-list-tile-action>
                                        <v-list-tile-content>
                                            <v-list-tile-title>777-867-5309</v-list-tile-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                    <v-list-tile>
                                        <v-list-tile-action>
                                            <v-icon class="blue--text text--lighten-2">place</v-icon>
                                        </v-list-tile-action>
                                        <v-list-tile-content>
                                            <v-list-tile-title>Tortosa, CAT</v-list-tile-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                    <v-list-tile>
                                        <v-list-tile-action>
                                            <v-icon class="blue--text text--lighten-2">email</v-icon>
                                        </v-list-tile-action>
                                        <v-list-tile-content>
                                            <v-list-tile-title>marcmestre@iesebre.com</v-list-tile-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                </v-list>
                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-container>
            </section>
            <footer class="footer-distributed">

                <div class="footer-left">

                    <p class="footer-links">
                        <a href="/">Home</a>
                        ·
                        <a href="/tasques">Tasques Vuetify</a>
                        ·
                        <a href="/tags">Tags</a>
                        ·
                        <a href="/perfil">Perfil</a>
                        ·
                        <a href="/changelog">Changelog</a>
                    </p>

                    <p class="footer-company-name">Marc Mestre Algueró &copy; 2019</p>
                </div>

                <div class="footer-center">

                    <p class="text-xs-center headline white--text" id="fgoogle">Introdueix el teu correu per a rebre totes les actualitzacions d'aquesta aplicació.</p>

                    <v-text-field
                            class="white--text"
                            label="Introdueix el teu correu electronic"
                            solo-inverted
                    ></v-text-field>

                </div>

                <div class="footer-right">

                    <p class="footer-company-about">
                        <span>Aplicació de tasques</span>
                        Aplicació de tasques realitzada per Marc Mestre Algueró per al cicle superior de 2on DAM al institut IES de l'Ebre, Tortosa.
                    </p>

                    <div class="footer-icons">

                        <a href="https://www.facebook.com/marc.m.alguero">
                            <img border="0" alt="facebook" src="/img/facebook.svg" style="white" width="30" height="30">
                        </a>

                        <a href="https://www.instagram.com/mrks145">
                            <img border="0" alt="instagram" src="/img/instagram.svg" style="white" width="30" height="30">
                        </a>

                        <a href="https://www.twitter.com/markis145">
                            <img border="0" alt="twitter" src="/img/twitter.svg" style="white" width="30" height="30">
                        </a>

                        <a href="https://www.github.com/markis145/tasks">
                            <img border="0" alt="github" src="/img/github.svg" style="white" width="30" height="30">
                        </a>

                    </div>

                </div>

            </footer>
        </v-content>
    </v-app>
@endsection