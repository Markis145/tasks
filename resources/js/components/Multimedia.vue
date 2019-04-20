<template>
    <span>
        <div>
            <video id="demovideo" src="http://clips.vorwaerts-gmbh.de/VfE_html5.mp4" preload="auto" controls></video>
            <v-flex xs12 sm6 lg4 offset-sm3 offset-lg4 mt-3 mb-5>
                <v-card>
                <v-slider
                        prepend-icon="volume_up"
                        v-model="volume"
                        color="primary"
                        @input="updateVolumeVideo(volume)"
                        max="1" step="any"
                        style="width: 20%">
                </v-slider>
                    <v-btn small fab outline @click="rewind('demovideo')" icon color="primary">
                        <v-icon color="primary">fast_rewind</v-icon>
                    </v-btn>
                    <v-btn outline @click="stop('demovideo')" icon color="primary">
                        <v-icon color="primary">stop</v-icon>
                    </v-btn>
                    <v-btn outline @click="play('demovideo')" icon color="primary">
                        <v-icon color="primary">play_arrow</v-icon>
                    </v-btn>
                    <v-btn outline @click="pause('demovideo')" icon color="primary">
                        <v-icon color="primary">pause</v-icon>
                    </v-btn>
                    <v-btn outline @click="forward('demovideo')" icon color="primary">
                        <v-icon color="primary">fast_forward</v-icon>
                    </v-btn>
                </v-card>
            </v-flex>
        </div>

        <div>
        <audio id="demoaudio" src="https://upload.wikimedia.org/wikipedia/en/4/45/ACDC_-_Back_In_Black-sample.ogg" preload="auto" controls></audio>
            <v-flex  xs12 sm6 lg4 offset-sm3 offset-lg4 mt-3 mb-5>
                <v-card>
                    <v-slider
                            prepend-icon="volume_up"
                            v-model="volumeAudio"
                            color="primary"
                            @input="updateVolumeAudio(volumeAudio)"
                            max="1" step="any"
                            style="width: 20%">
                    </v-slider>
                    <v-btn small fab outline @click="rewind('demoaudio')" icon color="primary">
                        <v-icon color="primary">fast_rewind</v-icon>
                    </v-btn>
                    <v-btn outline @click="stop('demoaudio')" icon color="primary">
                        <v-icon color="primary">stop</v-icon>
                    </v-btn>
                    <v-btn outline @click="play('demoaudio')" icon color="primary">
                        <v-icon color="primary">play_arrow</v-icon>
                    </v-btn>
                    <v-btn outline @click="pause('demoaudio')" icon color="primary">
                        <v-icon color="primary">pause</v-icon>
                    </v-btn>
                    <v-btn outline @click="forward('demoaudio')" icon color="primary">
                        <v-icon color="primary">fast_forward</v-icon>
                    </v-btn>
                </v-card>
            </v-flex>
        </div>
    </span>
</template>

<script>
export default {
  name: 'Multimedia.vue',
  data () {
    return {
      volume: 1,
      volumeAudio: 1
    }
  },
  methods: {
    play ($id) {
      document.getElementById($id).play()
    },
    pause ($id) {
      document.getElementById($id).pause()
    },
    stop ($id) {
      document.getElementById($id).currentTime += -9999999999
      document.getElementById($id).pause()
    },
    rewind ($id) {
      document.getElementById($id).currentTime += -10
    },
    forward ($id) {
      document.getElementById($id).currentTime += +10
    },
    updateVolumeVideo () {
      document.getElementById('demovideo').volume = this.volume
    },
    updateVolumeAudio () {
      document.getElementById('demoaudio').volumeAudio = this.volumeAudio
    }

  }
}
</script>

<style scoped>

</style>
