<template>
    <div class="text-xs-center">
        <v-dialog
                v-model="dialog"
                width="500"
        >
            <v-btn
                    slot="activator"
                    @click="networkInfo"
                    :loading="loading"
            >
                Network Info
            </v-btn>

            <v-card>
                <v-card-title
                        class="headline grey lighten-2"
                        primary-title
                >
                    Informació sobre la connexió
                </v-card-title>

                <v-card-text>
                    <p>Teòricament el tipus de la connexió és: <b id="networkType">not available</b>.</p>
                    <p>El tipus de la connexió és:<b id="effectiveNetworkType">not available</b>.</p>
                    <p>La velocitat màxima de descarrega és: <b id="downlinkMax">not available</b>.</p>
                </v-card-text>

                <v-divider></v-divider>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                            color="primary"
                            flat
                            @click="dialog = false"
                    >
                        Sortir
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
export default {
  name: 'Network',
  data () {
    return {
      loading: false,
      dialog: false
    }
  },
  methods: {
    networkInfo () {
      function getConnection () {
        return navigator.connection || navigator.mozConnection ||
          navigator.webkitConnection || navigator.msConnection
      }

      function updateNetworkInfo (info) {
        document.getElementById('networkType').innerHTML = info.type
        document.getElementById('effectiveNetworkType').innerHTML = info.effectiveType
        document.getElementById('downlinkMax').innerHTML = info.downlinkMax
      }

      var info = getConnection()
      if (info) {
        info.addEventListener('change', updateNetworkInfo)
        updateNetworkInfo(info)
      }
    }
  }
}
</script>

<style scoped>

</style>
