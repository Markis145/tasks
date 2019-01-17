<template>
    <v-flex xs12 sm4 offset-sm4 class="text-center">
        <img width="60%" :src="img" alt="">
        <h4 class="mt-4">{{ mainText }}</h4>
        <v-btn
                color="primary darken-1"
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
