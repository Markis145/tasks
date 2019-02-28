<template>
    <v-btn @click="vibrate">Vibrate</v-btn>
</template>

<script>
export default {
  name: 'Vibrate',
  methods: {
    vibrate () {
      navigator.vibrate(200)
    }
  }
}
</script>

<style scoped>

</style>
