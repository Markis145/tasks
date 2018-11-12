<template>
    <v-form action="/register" method="POST">
        <v-toolbar dark color="primary">
            <v-toolbar-title>Register form</v-toolbar-title>
        </v-toolbar>
        <v-card-text>
            <input type="hidden" name="_token" :value="csrfToken">
            <v-text-field
                    prepend-icon="person"
                    name="name"
                    label="Nom"
                    type="text"
                    v-model="name"
                    :error-messages="nameErrors"
                    @input="$v.name.$touch()"
                    @blur="$v.name.$touch()">
            </v-text-field>
            <v-text-field
                    prepend-icon="email"
                    name="email"
                    label="Correu electrònic"
                    type="text"
                    v-model="dataEmail"
                    :error-messages="emailErrors"
                    @input="$v.dataEmail.$touch()"
                    @blur="$v.dataEmail.$touch()"
            ></v-text-field>
            <v-text-field
                    id="password"
                    prepend-icon="lock"
                    name="password"
                    label="Password"
                    type="password"
                    :error-messages="passwordErrors"
                    @input="$v.password.$touch()"
                    @blur="$v.password.$touch()"
                    v-model="password">
            </v-text-field>
            <v-text-field
                    id="password_confirmation"
                    prepend-icon="lock"
                    name="password_confirmation"
                    label="Confirmació password"
                    type="password"
                    :error-messages="password_confirmationErrors"
                    @input="$v.password_confirmation.$touch()"
                    @blur="$v.password_confirmation.$touch()"
                    v-model="password_confirmation">
            </v-text-field>
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" type="submit" :disabled="$v.$invalid">Register</v-btn>
        </v-card-actions>
    </v-form>
</template>

<script>
import { validationMixin } from 'vuelidate'
import { required, email, minLength, sameAs } from 'vuelidate/lib/validators'

export default {
  name: 'RegisterForm',
  mixins: [validationMixin],
  validations: {
    name: { required, minLength: minLength(3) },
    dataEmail: { required, email },
    password: { required, minLength: minLength(6) },
    password_confirmation: { sameAsPassword: sameAs('password') }
  },
  data () {
    return {
      name: '',
      dataEmail: this.email,
      password: '',
      password_confirmation: ''
    }
  },
  props: {
    'email': '',
    'csrfToken': ''
  },
  computed: {
    emailErrors () {
      const errors = []
      if (!this.$v.dataEmail.$dirty) return errors
      !this.$v.dataEmail.email && errors.push('El camp email ha de ser tipus email.')
      !this.$v.dataEmail.required && errors.push('El camp email és obligatori.')
      return errors
    },
    passwordErrors () {
      const errors = []
      if (!this.$v.password.$dirty) return errors
      !this.$v.password.required && errors.push('El password és obligatori.')
      !this.$v.password.minLength && errors.push('El camp password ha de tenir una mida minima de 6 caràcters.')
      return errors
    },
    password_confirmationErrors () {
      const errors = []
      if (!this.$v.password.$dirty) return errors
      !this.$v.password_confirmation.sameAsPassword && errors.push('Les contrasenyes no coincideixen')
      return errors
    },
    nameErrors () {
      const errors = []
      if (!this.$v.name.$dirty) return errors
      !this.$v.name.required && errors.push('El nom és obligatori.')
      !this.$v.name.minLength && errors.push('El camp nom ha de tenir una mida minima de 3 caràcters.')
      return errors
    }
  }
}
</script>
