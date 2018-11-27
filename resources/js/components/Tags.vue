<template>
    <div>
        TODO TAGS
        <v-snackbar :timeout="snackbarTimeout" :color="snackbarColor" v-model="snackbar">
            {{ snackbarMessage }}
            <v-btn dark flat @click.native="snackbar=false">X</v-btn>
        </v-snackbar>
        <v-btn @click="showMessage('Hola soc un missatge Ulabox')">Show snackbar message</v-btn>
        <v-btn @click="showError('Hola soc un ERROR')">Show snackbar error</v-btn>
    </div>
</template>

<script>
export default {
  name: 'Tags',
  data () {
    return {
      value: '',
      snackbarMessage: 'Prova',
      snackbarTimeout: 3000,
      snackbarColor: 'success'
    }
  },
  methods: {
    showMessage (message) {
      this.snackbarMessage = message
      this.snackbarColor = 'success'
      this.snackbar = true
    },
    showError (error) {
      console.log(error)
      this.snackbarMessage = error.message
      this.snackbarColor = 'error'
      this.snackbar = true
    }
  }

}
</script>
