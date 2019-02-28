<template>
    <div>
        <v-layout class="justify-center">
            <v-flex  xs2 sm2 lg2>
                <v-card class="justify-center">
                    <p class="font-weight-bold subheading">Clica'm! -><v-btn icon @click="show" :loading="online"> <v-icon>wifi_tethering</v-icon></v-btn></p>
                    <p>Actualment estas: <b id="status">unknown</b>.</p>
                </v-card>
            </v-flex>
        </v-layout>
    </div>
</template>

<script>
export default {
  name: 'OnlineStatus',
  data () {
    return {
      online: false
    }
  },
  methods: {
    show () {
      document.getElementById('status').innerHTML = navigator.onLine ? 'online' : 'offline'

      var target = document.getElementById('target')

      function handleStateChange () {
        var timeBadge = new Date().toTimeString().split(' ')[0]
        var newState = document.createElement('p')
        var state = navigator.onLine ? 'online' : 'offline'
        newState.innerHTML = '<span class="badge">' + timeBadge + '</span> Connection state changed to <b>' + state + '</b>.'
        target.appendChild(newState)
      }

      window.addEventListener('online', handleStateChange)
      window.addEventListener('offline', handleStateChange)
    }
  }
}
</script>

<style scoped>

</style>
