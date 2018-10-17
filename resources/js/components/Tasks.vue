<template>
    <div id="tasks" class="flex justify-center tasks">
        <div class="flex flex-col">
            <h1 class="text-center text-red-light">Tasques({{total}}) </h1>
            <div class="flex-row"  >

                <div v-if="errorMessage">
                Ha succeit un error: {{ errorMessage }}
                </div>

                <input type="text" placeholder="Nova Tasca"
                       v-model="newTask" @keyup.enter="add"
                       class="m-3 mt-5 p-2 pl-5 shadow border rounded focus:outline-none focus:shadow-outline text-grey-darker">
                <button @click="add" class="text-center text-red"  >Afegir</button>
            </div>
            <!-- -->
            <div v-for="task in filteredTasks" :key="task.id">
            <span :id="'task' + task.id" :class="{ strike: task.completed=='1'}">
                <editable-text
                        :text="task.name"
                        @edited="editName(task, $event)"
                ></editable-text>
            </span>
                &nbsp;
                <span @click="remove(task)" class="cursor-pointer">&#215;</span>
            </div>
            <!-- -->
            <br>
            <h3>Filtros:</h3>
            <br>
            Filtre emprat -> {{ filter }}

            <div>
                <br>
                <button @click="setFilter('all')">Totes</button>
                <button @click="setFilter('completed')">Completades</button>
                <button @click="setFilter('active')">Pendents</button>
            </div>
        </div>
    </div>
</template>
<script>
import EditableText from './EditableText'
var filters = {
  all: function (tasks) {
    return tasks
  },
  completed: function (tasks) {
    return tasks.filter(function (task) {
      // return task.completed
      // NO CAL
      if (task.completed == '1') return true
      else return false
    })
  },
  active: function (tasks) {
    return tasks.filter(function (task) {
      if (task.completed == '0') return true
      else return false
    })
  }
}
export default {
  name: 'Tasks',
  components: {
    'editable-text': EditableText
  },
  data () {
    return {
      filter: 'all', // All Completed Active
      newTask: '',
      dataTasks: this.tasks,
      errorMessage: null
    }
  },
  props: {
    'tasks': {
      type: Array,
      default: function () {
        return []
      }
    }
  },
  computed: {
    total () {
      return this.dataTasks.length
    },
    filteredTasks () {
      // Segons el filtre actiu
      // Alternativa switch/case -> array associatiu
      return filters[this.filter](this.dataTasks)
    }
  },
  watch: {
    tasks (newTasks) {
      this.dataTasks = newTasks
    }
  },
  methods: {
    editName (task, text) {
      task.name = text
    },
    setFilter (newFilter) {
      this.filter = newFilter
    },
    add () {
      axios.post('/api/v1/tasks', {
        name: this.newTask
      }).then((response) => {
        this.dataTasks.splice(0, 0, { id: response.data.id, name: this.newTask, completed: false })
        this.newTask = ''
      }).catch((error) => {
        console.log(response)
      })
    },
    remove (task) {
      axios.delete('/api/v1/tasks/' + task.id).then((response) => {
        this.dataTasks.splice(this.dataTasks.indexOf(task), 1)
      }).catch((error) => {
        console.log(response)
      })
      window.console.log(task)
    }
  },
  created () {
    if (this.tasks.length === 0) {
      window.axios.get('/api/v1/tasks').then((response) => {
        console.log(response)
        console.log(response.data)
        this.dataTasks = response.data
      }).catch((error) => {
        console.log('xivato')
        this.errorMessage = error.data.message
      })
    }
    // console.log('Component Tasks ha estat creat');
  }
}
</script>

<style>
    .strike {
        text-decoration: line-through;
    }
</style>
