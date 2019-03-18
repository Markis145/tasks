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

        <v-card class="elevation-10 mb-2 hidden-md-and-up"
                v-touch="{ left: () => call('delete', task)}">
                        <v-list class="mr-1">
                            <v-card-title class="title font-weight-black">{{ task.name }}</v-card-title>
                            <v-list-tile>
                                <v-list-tile-content class="font-italic" style="color:#504847">{{ task.description }}</v-list-tile-content>
                                <v-avatar :title="(task.user !== null) ? task.user_name + ' - ' + task.user_email : ''">
                                    <img style=" width:150%; height:150%; border-radius:160px;" :src="(task.user !== null) ? task.user_gravatar : 'img/usuari.png'"
                                         alt="gravatar">
                                </v-avatar>
                            </v-list-tile>
                            <v-list-tile class="font-italic" style="color:gray">
                                <td v-if="task.user_id !== null" >
                                    {{task.user_email}}
                                </td>
                            </v-list-tile>
                            <v-list-tile style="color:gray" class="font-italic">
                                <td  v-if="task.completed">
                                    Completada
                                </td>
                            </v-list-tile>
                        </v-list>
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
