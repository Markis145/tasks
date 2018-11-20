<template>
    <v-list two-line>
        <template v-for="user in dataUsers">
        <v-list-tile>
            <v-list-tile-avatar>
                <v-avatar :title="user.name">
                    <img :src="user.avatar" alt="avatar">
                </v-avatar>
            </v-list-tile-avatar>
            <v-list-content>
                <v-list-tile-tilte v-text="user.name"></v-list-tile-tilte>
                <v-list-tile-sub-title v-text="user.email"></v-list-tile-sub-title>
            </v-list-content>
        </v-list-tile>
        <v-divider></v-divider>
        </template>
    </v-list>
</template>

<script>
export default {
  name: 'UserList.vue',
  data () {
    return {
      dataUsers: []
    }
  },
  props: {
    users: {
      type: Array
    }
  },
  created () {
    if (this.users) this.dataUser = this.users
    else {
      window.axios.get('/api/v1/users').then(response => {
        this.users = response.data
      }).catch(error => {
        console.log(error)
        // this.$snackbar.showMessage(error)
      })
    }
  }
}
</script>

<style scoped>

</style>
