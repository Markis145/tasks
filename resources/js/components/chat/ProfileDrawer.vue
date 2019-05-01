<template>
    <span>
        <v-navigation-drawer
                v-model="dataDrawer"
                fixed
                clipped
                app
        >
            <v-card>
                <v-card-title class="teal lighten-2 white--text">
                    <v-btn flat icon color="white" @click.stop="profileDrawer =! profileDrawer">
                        <v-icon>arrow_back</v-icon>
                    </v-btn>
                    <h4>Perfil</h4>
                </v-card-title>
                <v-card-text class="blue-grey lighten-5">
                     <chat-avatar></chat-avatar>
                </v-card-text>
                <v-card-text>
                    <v-card-text-title class="green--text left">Tu nombre</v-card-text-title>
                    <v-card-text>Marc Mestre A.</v-card-text>
                </v-card-text>
                <v-card-text class="blue-grey lighten-5 grey--text ">
                    Este no es tu nombre de usuario ni un PIN. Este nombre será visible para tus contactos de Whatsapp.
                </v-card-text>
            </v-card>
        </v-navigation-drawer>
    </span>
</template>

<script>
import ChatAvatar from './ChatAvatar'
export default {
  name: 'ProfileDrawer',
  components: { ChatAvatar },
  data () {
    return {
      dataDrawer: this.profileDrawer
    }
  },
  props: {
    profileDrawer: {
      Type: Boolean,
      default: false
    }
  },
  watch: {
    dataDrawer (newval) {
      this.$emit('input', newval)
    },
    profileDrawer (newval) {
      this.dataDrawer = newval
    }
  },
  model: {
    prop: 'profileDrawer',
    event: 'input'
  }
}
</script>

<style scoped>

</style>
