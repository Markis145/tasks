<template>
    <v-form>
        <v-text-field
                autofocus
                v-model="name"
                label="Nom"
                hint="El nom de la tasca..."
                placeholder="Nom de la tasca"
                :error-messages="nameErrors"
                @input="$v.name.$touch()"
                @blur="$v.name.$touch()"
        ></v-text-field>
        <v-switch v-model="completed" :label="completed ? 'Completada':'Pendent'"></v-switch>
        <v-textarea v-model="description" label="Descripció"></v-textarea>
        <user-select v-if="$can('tasks.index')" @selected="setUser" :users="dataUsers" label="Users"></user-select>
        <div class="text-xs-center">
            <v-btn @click="emit('close')">
                <v-icon class="mr-2">exit_to_app</v-icon>
                Cancel·lar
            </v-btn>
            <v-btn color="success" @click="add" :disabled="loading || $v.$invalid" :loading="loading">
                <v-icon class="mr-2">save</v-icon>
                Guardar
            </v-btn>
        </div>
    </v-form>
</template>

<script>
import { validationMixin } from 'vuelidate'
import { required } from 'vuelidate/lib/validators'
import UserSelect from './UserSelect'
export default {
  name: 'TaskForm',
  mixins: [validationMixin],
  validations: {
    name: { required }
  },
  components: {
    'user-select': UserSelect
  },
  data () {
    return {
      name: '',
      completed: false,
      user_id: '',
      description: '',
      loading: false,
      dataUsers: this.users
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
  computed: {
    nameErrors () {
      const errors = []
      if (!this.$v.name.$dirty) return errors
      !this.$v.name.required && errors.push('El camp name és obligatori.')
      return errors
    }
  },
  methods: {
    reset () {
      this.name = ''
      this.description = ''
      this.completed = false
      this.user_id = ''
    },
    add () {
      this.creating = true
      const task = {
        'name': this.name,
        'description': this.description,
        'completed': false,
        'user_id': this.user_id
      }
      window.axios.post(this.uri + '/', task).then((response) => {
        // this.createTask(response.data)
        this.$emit('created', response.data)
        this.$emit('close')
        this.$snackbar.showMessage("S'ha creat correctament la tasca")
      }).catch((error) => {
        this.creating = false
        this.$snackbar.showError(error.message)
      }).finally(() => {
        this.creating = false
        this.reset()
      })
    },
    setUser ($event) {
      this.user_id = $event
    }
  }
}
</script>
