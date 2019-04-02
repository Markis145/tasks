<template>
    <span>
        <v-menu
                v-model="showMenu"
                absolute
                offset-y
                style="max-width: 600px"
        >
        <template v-slot:activator="{ on }">
            <v-avatar v-on="on" :src="user.avatar" size="52px">
                <img :src=userAvatar alt="avatar">
            </v-avatar>
        </template>

        <v-list>
            <v-list-tile @click.stop="dialogVeureFoto = true">
                <v-list-tile-title>Veure foto</v-list-tile-title>
            </v-list-tile>
            <v-list-tile>
                <v-list-tile-title>Pendre foto</v-list-tile-title>
            </v-list-tile>
            <v-list-tile>
                <v-list-tile-title>Pujar foto</v-list-tile-title>
            </v-list-tile>
            <v-list-tile @click.stop="dialogEliminarFoto = true">
                <v-list-tile-title>Eliminar foto</v-list-tile-title>
            </v-list-tile>
        </v-list>
    </v-menu>

    <v-dialog
            v-model="dialogEliminarFoto"
            width="370"
            transition="slide-x-transition"
            @keydown.esc.stop.prevent="dialogEliminarFoto=false"
    >
        <v-card>
                <v-card-text>
                    Desitjes eliminar la teva foto de perfil?
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>

                    <v-btn
                            color="green darken-1"
                            flat="flat"
                            @click="dialogEliminarFoto = false"
                    >
                        Cancelar
                    </v-btn>

                    <v-btn
                            color="green"
                            class="text-white"
                            @click="dialogEliminarFoto = false"
                    >
                        Eliminar
                    </v-btn>
                </v-card-actions>
            </v-card>
    </v-dialog>

    <v-dialog
            v-model="dialogVeureFoto"
            fullscreen
            hide-overlay
            transition="slide-x-transition"
            @keydown.esc.stop.prevent="dialogVeureFoto=false"
    >
        <v-card>
            <v-card-title>
                <v-avatar v-on="on" :src="user.avatar" size="52px" @click="$emit('toggleright')">
                    <img :src=userAvatar alt="avatar">
                </v-avatar>
                &nbsp;
                <span class="subheading">+34 666 666 666</span>
                <v-spacer> </v-spacer>
                <v-tooltip bottom>
                    <v-btn @click="dialogVeureFoto = false" slot="activator" icon>
                        <v-icon>close</v-icon>
                    </v-btn>
                    <span>Sortir</span>
                </v-tooltip>
            </v-card-title>
            <v-card-text class="text-xs-center">
                <v-avatar v-on="on" :src="user.avatar" size="650px" tile @click="$emit('toggleright')">
                    <img src="https://i.ibb.co/MCnF5wC/moo.png" alt="avatar">
                </v-avatar>
            </v-card-text>
        </v-card>
    </v-dialog>
    </span>
</template>

<script>
export default {
  name: 'ChatAvatar',
  data () {
    return {
      showMenu: false,
      dialogVeureFoto: false,
      dialogEliminarFoto: false,
      userAvatar: window.laravel_user.gravatar
    }
  },
  created () {
    this.user = window.laravel_user
  }
}
</script>

<style scoped>

</style>
