<template>

    <span>

        <v-form class="hidden-sm-and-down">
            <v-text-field v-model="task.name" label="Nom" hint="Nom de la tasca"
                          readonly></v-text-field>
            <v-switch v-model="task.completed" :label="task.completed ? 'Completada':'Pendent'"
                      readonly></v-switch>
            <v-textarea v-model="task.description" label="Descripció" readonly></v-textarea>
            <v-autocomplete :items="dataUsers" label="Usuari" v-model="task.user" item-text="name"
                            return-object readonly></v-autocomplete>
        </v-form>

        <v-card color="grey lighten-4" class="elevation-5 mr-2 ml-2 hidden-md-and-up" v-touch="{
                                    left: () => call('delete', task)
                            }">
            <v-layout>
                <v-flex xs5>
                    <v-img :src="(task.user !== null) ? task.user_gravatar : 'img/user_profile.png'" height="125px"
                           contain></v-img>
                </v-flex>
                <v-flex xs7>
                    <v-card-title primary-title>
                        <div>
                            <div class="headline">{{ task.user_name }}</div>
                            <div class="subheading"
                                 style="width:160px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{
                                task.name }}
                            </div>
                            <div v-if="task.completed" style="color: #1abf00">Completada</div>
                            <div v-else style="color: #8C3D10">Pendent</div>
                        </div>
                    </v-card-title>
                </v-flex>
            </v-layout>
        </v-card>
    </span>
</template>

<script>
  export default {
    name: 'ShowOneTask',
    data () {
      return {
        dataUsers: this.users,
        user: '',
        dataTasks: this.task
      }
    },
    props: ['task', 'users']
  }
</script>