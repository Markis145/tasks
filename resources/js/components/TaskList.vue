<template>
    <span>
        <v-toolbar color="primary">
            <v-menu>
                <v-btn slot="activator" icon dark>
                    <v-icon>more_vert</v-icon>
                </v-btn>
                <v-list>
                    <v-list-tile>
                        <v-list-tile-title>Opció 1</v-list-tile-title>
                    </v-list-tile>
                    <v-list-tile href="https://google.com">
                        <v-list-tile-title>Google</v-list-tile-title>
                    </v-list-tile>
                </v-list>
            </v-menu>
            <v-toolbar-title class="white--text">Tasques</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn icon class="white--text">
                <v-icon>settings</v-icon>
            </v-btn>
             <v-tooltip top>
      <v-btn slot="activator" dark icon class="white--text" @click="refresh" :loading="loading" :disabled="loading">
         <v-icon>refresh</v-icon>
      </v-btn>
      <span>Refrescar</span>
    </v-tooltip>
        </v-toolbar>
        <v-card>
            <v-card-title>
                <v-expansion-panel v-if="$vuetify.breakpoint.smAndDown">
                        <v-expansion-panel-content>
                            <div slot="header">Filtres</div>
                            <v-flex lg3 class="pr-2">
                        <v-select
                                label="Filtres"
                                :items="filters"
                                v-model="statusBy"
                                item-text="name"
                                :return-object="true"
                        >
                        </v-select>
                    </v-flex>
                    <v-flex lg4 class="pr-2">
                      <user-select
                              url="/api/v1/users"
                              label="Usuari"
                              v-model="filterUser"
                              :users="dataUsers"
                      ></user-select>
                    </v-flex>
                    <v-flex lg5>
                        <v-text-field
                                append-icon="search"
                                label="Buscar"
                                v-model="search"
                        ></v-text-field>
                    </v-flex>
                        </v-expansion-panel-content>
                    </v-expansion-panel>
                <v-layout v-else>
                    <v-flex lg3 class="pr-2">
                        <v-select
                                label="Filtres"
                                :items="filters"
                                v-model="statusBy"
                                item-text="name"
                                :return-object="true"
                        >
                        </v-select>
                    </v-flex>
                    <v-flex lg4 class="pr-2">
                      <user-select
                              url="/api/v1/users"
                              label="Usuari"
                              v-model="filterUser"
                              :users="dataUsers"
                      ></user-select>
                    </v-flex>
                    <v-flex lg5>
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
                    :items="getFilteredTasks"
                    :search="search"
                    no-results-text="No s'ha trobat cap registre coincident"
                    no-data-text="No hi han dades disponibles"
                    rows-per-page-text="Tasques per pàgina"
                    :rows-per-page-items="[5,10,25,50,100,200,{'text':'Tots','value':-1}]"
                    :loading="loading"
                    :pagination.sync="pagination"
                    class="hidden-sm-and-down"
            >
                <v-progress-linear slot="progress" color="secondary" indeterminate></v-progress-linear>
                <template slot="items" slot-scope="{item: task}">
                    <tr>
                        <td>{{ task.id }}</td>
                        <td>
                            <span :title="task.description">{{ task.name }}</span>
                        </td>
                        <td v-if="task.user_id !== null" >
                            <v-avatar :title="task.user_name + ' - ' + task.user_email">
                                <img :src="task.user_gravatar" alt="gravatar">

                            </v-avatar>
                            {{task.user_email}}
                        </td>

                        <td v-else>
                            <v-avatar title="No user">
                                <img src="img/usuari.png" alt="gravatar">
                            </v-avatar>
                        </td>
                        <td>
                            <task-completed-toggle :status="task.completed"  :task="task" :tags="tags"></task-completed-toggle>
                        </td>
                        <td>
                            <tasks-tags :task="task" :task-tags="task.tags" :tags="tags" @change="refresh(false)"></tasks-tags>
                        </td>
                        <td>
                            <span :title="task.created_at_formatted">{{ task.created_at_human}}</span>
                        </td>
                        <td>
                            <span :title="task.updated_at_formatted">{{ task.updated_at_human}}</span>
                        </td>
                        <td class="d-flex">
                            <task-show :users="users" :task="task" :uri="uri"></task-show>

                            <task-update :users="users" :task="task" @updated="updateTask" :uri="uri"></task-update>

                            <task-destroy :task="task" @removed="removeTask" :uri="uri"></task-destroy>
                        </td>
                    </tr>
                </template>
            </v-data-table>
            <v-data-iterator class="hidden-md-and-up ma-1"
                             :items="dataTasks"
                             :search="search"
                             no-results-text="No s'ha trobat cap registre coincident"
                             no-data-text="No hi han dades disponibles"
                             rows-per-page-text="Tasques per pàgina"
                             :rows-per-page-items="[5,10,25,50,100,200,{'text':'Tots','value':-1}]"
                             :loading="loading"
                             :pagination.sync="pagination"
            >
                <v-flex
                        slot="item"
                        slot-scope="{item:task}"
                        xs12
                        offset-sm2
                        sm8
                >

                    <v-card class="elevation-10 mb-2"
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
                            <hr>
                            <v-list-tile>
                                <v-spacer></v-spacer>
                                <v-list-tile-content>
                                    <share-task :task="task"></share-task>
                                </v-list-tile-content>
                                <v-list-tile-content>
                                    <task-show :users="users" :task="task" :uri="uri"></task-show>
                                </v-list-tile-content>
                                <v-list-tile-content>
                                    <task-update :users="users" :task="task" @updated="updateTask" :uri="uri"></task-update>
                                </v-list-tile-content>
                                <v-list-tile-content>
                                    <task-destroy :task="task" :mobile="true" @removed="removeTask" :uri="uri"></task-destroy>
                                </v-list-tile-content>
                            </v-list-tile>
                        </v-list>
                    </v-card>
                </v-flex>
            </v-data-iterator>
        </v-card>
    </span>
</template>

<script>
import TaskCompletedToggle from './TaskCompletedToggle'
import TaskDestroy from './TaskDestroy'
import TaskUpdate from './TaskUpdate'
import TaskShow from './TaskShow'
import TasksTags from './TasksTags'
import EventBus from './../eventBus'
import ShareTask from './ShareTask'
export default {
  name: 'TasksList',
  components: {
    'task-destroy': TaskDestroy,
    'task-update': TaskUpdate,
    'task-show': TaskShow,
    'task-completed-toggle': TaskCompletedToggle,
    'tasks-tags': TasksTags,
    'share-task': ShareTask
  },
  data () {
    return {
      user: '',
      user_id: '',
      loading: false,
      dataTasks: this.tasks,
      dataUsers: this.users,
      filter: 'Totes',
      filterUser: null,
      filters: [
        { name: 'Totes', value: 'Totes' },
        { name: 'Completades', value: true },
        { name: 'Pendents', value: false }
      ],
      statusBy: { name: 'Totes', value: 'Totes' },
      search: '',
      pagination: {
        rowsPerPage: 5
      },
      headers: [
        { text: 'Id', value: 'id' },
        { text: 'Name', value: 'name' },
        { text: 'User', value: 'user_id' },
        { text: 'Completat', value: 'completed' },
        { text: 'Etiquetes', value: 'tags' },
        { text: 'Creat', value: 'created_at_timestamp' },
        { text: 'Modificat', value: 'updated_at_timestamp' },
        { text: 'Accions', sortable: false, value: 'full_search' }
      ]
    }
  },
  props: {
    tasks: {
      type: Array,
      required: true
    },
    tags: {
      type: Array,
      required: true
    },
    users: {
      type: Array,
      required: true
    },
    uri: {
      type: String,
      required: true
    }
  },
  watch: {
    tasks (newTasks) {
      this.dataTasks = newTasks
    }
  },
  computed: {
    getFilteredTasks () {
      let filterUser = this.filterUser
      let statusBy = this.statusBy
      let tasks = this.dataTasks
      if (filterUser == null) {
        tasks = this.dataTasks
      } else if (filterUser !== null) {
        tasks = tasks.filter((task) => {
          if (task.user_id == filterUser.id) return true
          else return false
        })
      }
      if (statusBy.value != 'Totes') {
        tasks = tasks.filter((task) => {
          if (task.completed == statusBy.value) return true
          else return false
        })
      }
      return tasks
    }
  },
  methods: {
    removeTask (task) {
      this.dataTasks.splice(this.dataTasks.indexOf(task), 1)
    },
    updateTask (task) {
      this.refresh()
    },
    refresh (message = true) {
      this.loading = true
      window.axios.get(this.uri).then(response => {
        this.dataTasks = response.data
        this.loading = false
        if (message) this.$snackbar.showMessage('Tasques actualitzades correctament')
      }).catch(() => {
        this.loading = false
      })
    },
    call (action, object) {
      EventBus.$emit('touch-' + action, object)
    }
  },
  created () {
    console.log('Registering laravel echo')
    console.log('User id: ')
    console.log(window.laravel_user.id)
    console.log('Is admin: ')
    console.log(window.laravel_user.admin)
    if (window.laravel_user.admin) {
      console.log('admiiiin')
      window.Echo.private('Tasques')
        .listen('TaskUncompleted', (e) => {
          console.log('TaskUncompleted Received')
          console.log(e.task)
          this.refresh()
        })
        .listen('TaskCompleted', (e) => {
          console.log('TaskCompleted Received')
          console.log(e.task)
          this.refresh()
        })
        .listen('TaskStore', (e) => {
          console.log('TaskStore Received')
          console.log(e.task)
          this.refresh()
        })
        .listen('TaskModify', (e) => {
          console.log('TaskModify Received')
          console.log(e.task)
          this.refresh()
        })
        .listen('TaskDelete', (e) => {
          console.log('TaskDelete Received')
          console.log(e.task)
          this.refresh()
        })
    } else {
      console.log('no admiiiin')
      window.Echo.private('App.User.' + window.laravel_user.id)
        .listen('TaskUncompleted', (e) => {
          console.log('TaskUncompleted Received')
          console.log(e.task)
          this.refresh()
        })
        .listen('TaskCompleted', (e) => {
          console.log('TaskCompleted Received')
          console.log(e.task)
          this.refresh()
        })
        .listen('TaskStore', (e) => {
          console.log('TaskStore Received')
          console.log(e.task)
          this.refresh()
        })
        .listen('TaskModify', (e) => {
          console.log('TaskModify Received')
          console.log(e.task)
          this.refresh()
        })
        .listen('TaskDelete', (e) => {
          console.log('TaskDelete Received')
          console.log(e.task)
          this.refresh()
        })
    }
  }
}
</script>
