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
            <v-list-tile
                    @click="selectFiles"
                    :loading="uploading"
                    :disabled="uploading">
                <v-list-tile-title>Pendre foto</v-list-tile-title>
                <form action="/photo" method="POST" enctype="multipart/form-data">
                    <input type="file" name="photo" id="photo-file-input" ref="photo" accept="image/*">
                </form>
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
  preview () {
    if (this.$refs.photo.files && this.$refs.photo.files[0]) {
      var reader = new FileReader()
      reader.onload = e => {
        this.$refs.img_photo.setAttribute('src', e.target.result)
      }
      reader.readAsDataURL(this.$refs.photo.files[0])
    }
  },
  created () {
    this.user = window.laravel_user
  },
  selectFiles () {
    this.$refs.photo.click()
  },
  upload () {
    const formData = new FormData()
    formData.append('photo', this.$refs.photo.files[0])
    // Preview it
    this.preview()
    // save it
    this.save(formData)
  },
  save (formData) {
    this.uploading = true
    var config = {
      onUploadProgress: progressEvent => {
        this.percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total)
      }
    }
    window.axios.post('/api/v1/user/photo', formData, config)
      .then(() => {
        this.uploading = false
        this.$snackbar.showMessage('La foto ha estat pujada correctament!')
      })
      .catch(error => {
        this.uploading = false
      })
  },
}
</script>


<style scoped>
    input[type=file] {
        position: absolute;
        left: -99999px;
    }
</style>