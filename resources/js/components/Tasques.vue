<template>
    <span>
        <v-dialog v-model="deleteDialog" width="500">
            <v-card>
                <v-card-title class="headline">Esteu segurs?</v-card-title>

                <v-card-text>
                    Aquesta operació no es pot desfer.
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                      <v-btn
                              color="green darken-1"
                              flat
                              @click="deleteDialog = false"
                      >
                        Cancel·lar
                      </v-btn>

                      <v-btn
                              color="error darken-1"
                              flat="flat"
                              @click="destroy"
                      >
                        Confirmar
                      </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <v-dialog v-model="createDialog" fullscreen hide-overlay transition="dialog-bottom-transition">
            <v-card>
                TODO CREATE DIALOG
            </v-card>
        </v-dialog>
        <v-dialog v-model="editDialog" fullscreen hide-overlay transition="dialog-bottom-transition">
            <v-toolbar color="blue darken-3" class="white--text">
                <v-toolbar-title class="white--text">Editar Tasca</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn flat class="white--text">
                    <v-icon class="mr-1">exit_to_app</v-icon>
                    SORTIR
                </v-btn>
                <v-btn flat class="white--text">
                    <v-icon class="mr-1">save</v-icon>
                    Guardar
                </v-btn>
            </v-toolbar>
            <v-card>
                <v-card-text>
                    TODO AQUI EDIT DIALOG
                </v-card-text>
            </v-card>
        </v-dialog>
        <v-snackbar :timeout="3000" color="success" v-model="snackbar">
            Això és un snackbar
            <v-btn dark flat @click.native="snackbar=false">X</v-btn>
        </v-snackbar>
        <v-toolbar color="blue darken-3">
            <v-menu>
                <v-btn slot="activator" icon dark>
                    <v-icon>more_vert</v-icon>
                </v-btn>
                <v-list>
                    <v-list-tile @click="opcio1">
                        <v-list-tile-title>Opció 1</v-list-tile-title>
                    </v-list-tile>
                    <v-list-tile href="http://google.com">
                        <v-list-tile-title>Google</v-list-tile-title>
                    </v-list-tile>
                </v-list>
            </v-menu>
            <v-toolbar-title class="white--text">Tasques</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn icon class="white--text">
                <v-icon>settings</v-icon>
            </v-btn>
            <v-btn icon class="white--text" @click="refresh" :loading="loading" :disabled="loading">
                <v-icon>refresh</v-icon>
            </v-btn>
        </v-toolbar>
        <v-card>
            <v-card-title>
                <v-layout row wrap>
                    <v-flex xs3 class="pr-2">
                        <v-select
                                label="Filtres"
                                :items="filters"
                                v-model="filter">
                        </v-select>
                    </v-flex>
                    <v-flex xs4 class="pr-2">
                        <v-select
                                label="Users"
                                :items="users"
                                v-model="user"
                                clearable>
                        </v-select>
                    </v-flex>
                    <v-flex xs5>
                        <v-text-field
                            append-icon="search"
                            label="Buscar"
                            v-model="search"
                        ></v-text-field>
                    </v-flex>
                </v-layout>
            </v-card-title>
            <v-data-table
                    :headers="headers"
                    :items="dataTasks"
                    :search="search"
                    no-results-text="No s'ha trobat cap registre coincident"
                    no-data-text="No hi ha dades disponibles"
                    rows-per-page-text="Tasques per pàgina"
                    :rows-per-page-items="[5,10,25,50,100,200,{'text':'Tots','value':-1}]"
                    :loading="loading"
                    :pagination.sync="pagination"
            >
                <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
                <template slot="items" slot-scope="{item: task}">
                    <tr>
                        <td>{{ task.id }}</td>
                        <td v-text="task.name"></td>
                        <td v-text="task.user_id"></td>
                        <td v-text="task.completed"></td>
                        <td v-text="task.created_at"></td>
                        <td v-text="task.updated_at"></td>
                        <td>
                            <v-btn icon color="primary" flat title="Mostrar snackbar"
                                   @click="snackbar=true">
                                <v-icon>info</v-icon>
                            </v-btn>
                            <v-btn icon color="primary" flat title="Mostrar la tasca"
                                    @click="show(task)">
                                <v-icon>visibility</v-icon>
                            </v-btn>
                            <v-btn icon color="success" flat title="Actualitzar la tasca"
                                   @click="showUpdate(task)">
                                <v-icon>edit</v-icon>
                            </v-btn>
                            <v-btn icon color="error" flat title="Eliminar la tasca"
                                   @click="showDestroy(task)">
                                <v-icon>delete</v-icon>
                            </v-btn>
                        </td>
                    </tr>
                </template>
            </v-data-table>
        </v-card>
        <v-btn
            @click="showCreate"
            fab
            bottom
            right
            fixed
            color="pink"
            class="white--text"
        >
            <v-icon>add</v-icon>
        </v-btn>
    </span>
</template>

<script>
export default {
  name: 'Tasques',
  data () {
    return {
      createDialog: false,
      deleteDialog: false,
      editDialog: false,
      snackbar: true,
      user: '',
      users: [
        'Marc Mestre',
        'Cristian Marin',
        'Sergi Baucells',
        'Benjamin Zaragoza'
      ],
      filter: 'Totes',
      filters: [
        'Totes',
        'Completades',
        'Pendents'
      ],
      search: '',
      pagination: {
        rowsPerPage: 25
      },
      loading: false,
      dataTasks: this.tasks,
      headers: [
        { text: 'Id', value: 'id' },
        { text: 'Name', value: 'name' },
        { text: 'Usuari', value: 'user_id' },
        { text: 'Completat', value: 'completed' },
        { text: 'Creat', value: 'created_at' },
        { text: 'Modificat', value: 'updated_at' },
        { text: 'Accions', sortable: false }
      ]
    }
  },
  props: {
    tasks: {
      type: Array,
      required: true
    }
  },
  methods: {
    showUpdate () {
      this.editDialog = true
    },
    opcio1 () {
      console.log('Todo Opcio')
    },
    showDestroy (task) {
      this.deleteDialog = true
      console.log('Todo delete task' + task.id)
    },
    destroy (task) {
      console.log('Todo delete task' + task.id)
    },
    showCreate (task) {
      this.createDialog = true
      console.log('Todo delete task')
    },
    create (task) {
      console.log('Todo delete task')
    },
    update (task) {
      console.log('Todo update task' + task.id)
    },
    show (task) {
      console.log('Todo show task' + task.id)
    },
    refresh () {
      this.loading = true
      // setTimeout(() => { this.loading = false }, 5000)
      window.axios.get('/api/v1/user/tasks').then(response => {
      //  SHOW SNACKBAR MSISATGE OK: 'les tasques s'han actualitzar correctament'
        this.dataTasks = response.data
      }).catch(error => {
        console.log(error)
        // SHOW SNACKBAR ERROR TODO
      })
    }
  }
}
</script>
