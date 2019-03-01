<template>
    <div>
        <v-layout class="justify-center">
            <v-flex  xs6 sm2 lg2>
                <v-card class="justify-center">
                    <p class="font-weight-bold subheading">Clica'm! -><v-btn icon @click="show" :loading="online"> <v-icon>memory</v-icon></v-btn></p>
                    <p>Memoria del dispositiu: <b id="result">unknown</b> GB.</p>
                </v-card>
            </v-flex>
        </v-layout>
    </div>
</template>

<script>
export default {
  name: 'Memory',
  data () {
    return {
      online: false
    }
  },
  methods: {
    show () {
      document.getElementById('result').innerHTML = navigator.deviceMemory || 'unknown'
    }
  }
}
</script>

<style scoped>

</style>
