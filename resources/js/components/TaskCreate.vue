<template>
    <span>
     <v-dialog v-model="dialog" fullscreen transition="dialog-bottom-transition" @keydown.esc.stop.prevent="dialog=false">
            <v-toolbar color="primary" class="white--text">
                <v-btn flat icon class="white--text" @click="dialog=false">
                    <v-icon>close</v-icon>
                </v-btn>
                <v-card-title class="headline">Crear tasca</v-card-title>
                 <v-icon class="white--text">assignment_turned_in</v-icon>
                <v-spacer></v-spacer>
                <v-btn flat class="white--text" @click="dialog=false">
                    <v-icon class="mr-2">exit_to_app</v-icon>
                    Sortir
                </v-btn>
                <v-btn flat class="white--text">
                   <v-icon class="mr-2">save</v-icon>
                   Guardar
                </v-btn>
            </v-toolbar>
            <v-card>
                <v-card-text>
                    <task-form :users="users" :uri="uri" @close="dialog=false" @created="created" @update="update"></task-form>
                </v-card-text>
            </v-card>
        </v-dialog>
        <v-btn
                @click="dialog = true"
                fab
                bottom
                right
                fixed
                large
                ripple
                color="secondary"
                class="white--text">
                <v-icon>add</v-icon>
        </v-btn>
    </span>
</template>

<script>
import TaskForm from './TaskForm'
import EventBus from './../eventBus'
export default {
  name: 'TaskCreate',
  components: {
    'task-form': TaskForm
  },
  data () {
    return {
      dialog: false
    }
  },
  props: {
    users: {
      type: Array,
      required: true
    },
    uri: {
      type: String,
      required: true
    }
  },
  methods: {
    created (task) {
      this.$emit('created', task)
    },
    update (task) {
      this.refresh()
    }
  },
  mounted () {
    EventBus.$on('cta', () => {
      this.dialog = true
    })
  }
}
</script>

<style scoped>
</style>
