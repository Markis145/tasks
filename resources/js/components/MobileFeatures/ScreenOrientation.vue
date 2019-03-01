<template>
    <div>
        <v-layout class="justify-center">
            <v-flex  xs6 sm2 lg2>
                <v-card class="justify-center">
                    <p class="font-weight-bold subheading">Clica'm! -><v-btn icon @click="show" :loading="orientation"> <v-icon>screen_rotation</v-icon></v-btn></p>
                    <p>L'orientació de la pantalla és: <b id="orientationType">unknown</b>.</p>
                </v-card>
            </v-flex>
        </v-layout>
    </div>
</template>

<script>
export default {
  name: 'ScreenOrientation',
  data () {
    return {
      orientation: false
    }
  },
  methods: {
    show () {
      var $ = document.getElementById.bind(document);

      var orientKey = 'orientation';
      if ('mozOrientation' in screen) {
        orientKey = 'mozOrientation';
      } else if ('msOrientation' in screen) {
        orientKey = 'msOrientation';
      }

      var orientationTypeLabel = $('orientationType');

      if (screen[orientKey]) {
        function update() {
          var type = screen[orientKey].type || screen[orientKey];
          orientationTypeLabel.innerHTML = type;

          var landscape = type.indexOf('landscape') !== -1;

          var rotate = type.indexOf('secondary') === -1 ? 0 : 180;
          var rotateStr = 'rotate(' + rotate + 'deg)';

        }

        update();
      }
    }
  }
}
</script>

<style scoped>

</style>
