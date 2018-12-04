<template>
    <v-switch v-model="dataTask.completed" :loading="loading" :disabled="loading" :label="dataTask.completed ? 'Completada' : 'Pendent'"></v-switch>
</template>

<script>
export default {
  name: 'taskCompletedToggle',
  data () {
    return {
      loading: null,
      dataTask: this.task
    }
  },
  props: {
    task: {
      type: Object,
      required: true
    }
  },
  watch: {
    dataTask: {
      handler: function (dataTask) {
        if (dataTask.completed) this.completeTask()
        else this.uncompleteTask()
      },
      deep: true
    }
  },
  methods: {
    completeTask () {
      // loading i disabled
      window.axios.post('/api/v1/completed_task/' + this.task.id)
    },
    uncompleteTask () {
      window.axios.delete('/api/v1/completed_task/' + this.task.id)
    }

  }
}
</script>
