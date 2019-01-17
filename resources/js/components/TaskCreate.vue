<template>
    <span>
        <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition"
                  @keydown.esc="dialog=false">
            <v-toolbar color="primary" class="white--text">
                <v-btn icon flat class="white--text">
                    <v-icon class="mr-1" @click="dialog=false">close</v-icon>
                </v-btn>
                <v-toolbar-title class="white--text">Crear Tasca</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn flat class="white--text" @click="dialog=false">
                    <v-icon class="mr-1" >exit_to_app</v-icon>
                    SORTIR
                </v-btn>
                <v-btn flat class="white--text">
                   <v-icon class="mr-2">save</v-icon>
                   Guardar
                </v-btn>
            </v-toolbar>
            <v-card>
                <v-card-text>
                    <task-form :users="users" :uri="uri" @close="dialog=false" @created="$emit('created')"></task-form>
                </v-card-text>
            </v-card>
        </v-dialog>
        <v-btn
                @click="dialog = true"
                fab
                bottom
                right
                fixed
                color="secondary"
                class="white--text"
        >
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
    },
    mounted () {
      EventBus.$on('cta', () => {
        this.dialog = true
      })
    }
  }
}
</script>
