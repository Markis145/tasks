<template>
    <v-form>
        <v-text-field v-model="name" label="Nom" hint="Nom de la tasca" placeholder="Nom de la tasca"></v-text-field>
        <v-switch v-model="completed" :label="completed ? 'Completada':'Pendent'"></v-switch>                        <v-textarea v-model="description" label="Descripció" item-value="id"></v-textarea>
        <v-autocomplete v-if="$can('tasks.index')" v-model="user_id    " :items="dataUsers" label="Usuari" item-value="id" item-text="name"></v-autocomplete>
        <user-select v-model="user_id" :users="dataUsers" label="Usuari"></user-select>
        <div class="text-xs-center">
            <v-btn @click="$emit('close')">
                <v-icon class="mr-2">exit_to_app</v-icon>
                Cancel·lar
            </v-btn>
            <v-btn color="success"
                   flat
                   @click="add"
                   :loading="loading"
                   :disabled="loading">
                <v-icon class="mr-2">save</v-icon>
                Guardar
            </v-btn>
        </div>
    </v-form>
</template>

<script>
import UserSelect from "./UserSelect"
export default {
  name: 'TaskForm',
  components: {UserSelect},
  data () {
    return {
      name: '',
      completed: '',
      description: '',
      user_id: null,
      dataUsers: this.users,
      loading: false
    }
  },
  props: {
    users: {
      type: Array,
      required: true
    },
    uri: {
      type: String,
      default: '/api/v1/tasks'
    }
  },
  methods: {
    reset () {
      this.name = ''
      this.description = ''
      this.user_id = ''
      this.completed = ''
    },
    add () {
      const task = {
        'name': this.name,
        'description': this.description,
        'completed': this.completed,
        'user_id': this.user_id
      }
      console.log(this.newTask)
      window.axios.post(this.uri, task).then((response) => {
        this.$snackbar.showMessage("S'ha creat correctament la tasca")
        this.$emit('created', response.data)
        this.$emit('close')
        this.refresh()
      }).catch(error => {
        this.$snackbar.showError(error.message)
        this.loading = false
      })
    }
  }
}
</script>
