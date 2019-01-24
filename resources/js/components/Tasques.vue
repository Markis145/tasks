<template>
    <v-layout row>
        <v-flex>
            <v-card>
                <snackbar></snackbar>
                <task-list v-show="dataTasks.length > 0" :users="users" :uri="uri" :tasks="dataTasks" :tags="tags"></task-list>
                <task-create :users="users" :uri="uri" @created="add" ></task-create>
            </v-card>
            <no-data-cta
                    v-show="dataTasks.length == 0"
                    btn-text="Crear nova tasca"
                    main-text="Actualment no hi ha cap tasca disponible... Crea'n una ara i comença a organitzar millor les teves tasques diàries"
                    img="/img/tasks-solid.svg"
            ></no-data-cta>
        </v-flex>
    </v-layout>
</template>

<script>
import TaskCreate from './TaskCreate'
import TaskList from './TaskList'
import NoDataCTA from './NoDataCTAComponent'
export default {
  name: 'Tasques',
  components: {
    'task-create': TaskCreate,
    'task-list': TaskList,
    'no-data-cta': NoDataCTA
  },
  data () {
    return {
      dataTasks: this.tasks
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
  methods: {
    add (task) {
      this.dataTasks.push(task)
    }
  }
}
</script>
