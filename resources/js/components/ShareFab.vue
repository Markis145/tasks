<template>
    <v-btn
            v-if="show"
            v-model="fab"
            color="accent"
            dark
            fab
            fixed
            bottom
            right
            large
            ripple
            @click="share"
    >
        <v-icon>share</v-icon>
    </v-btn>
</template>

<script>
export default {
  name: 'ShareFab',
  data () {
    return {
      fab: false
    }
  },
  methods: {
    share () {
      if (!('share' in navigator)) {
        return
      }

      navigator.share({
        title: "L'app de tasques de Marc Mestre",
        text: "L'app de tasques de Marc Mestre com a projecte de 2º de DAM",
        url: 'https://tasks.marcmestre.scool.cat/'
      })
        .then(() => console.log('Successful share'))
        .catch(error => console.log('Error sharing:', error))
    }
  },
  computed: {
    show () {
      return ('share' in navigator)
    }
  }
}
</script>
