<template>
    <v-flex xs12 sm4 offset-sm4 class="text-center">
        <img width="70%" :src="img" alt="">
        <h3 class="mt-4">{{ mainText }}</h3>
        <v-btn
                color="primary darken-1"
                large
                @click="emitCTA"
        >{{ btnText }}</v-btn>
    </v-flex>
</template>

<script>
import EventBus from './../eventBus'
export default {
  name: 'NoDataCTAComponent',
  props: ['img', 'btnText', 'mainText'],
  methods: {
    emitCTA () {
      EventBus.$emit('cta')
    }
  }
}
</script>

<style scoped>
</style>
