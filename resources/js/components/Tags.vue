<template>
    <v-container grid-list-md text-xs-center id="tags" class="tags">
        <v-layout row wrap>
            <v-flex xs12>
                <v-card width="500">
                    <v-card-title dark color="primary">
                        <span class="title">Tags ({{total}})</span>
                    </v-card-title>
                    <v-card-text class="px-0">
                        <form>
                            <v-text-field
                                    label="Tag a afegir"
                                    type="text"
                                    v-model="newTag" @keyup.enter="add"
                                    name="name"
                                    required>
                            </v-text-field>
                            <v-btn id="button_add_tag" @click="add">Afegir</v-btn>
                        </form>
                        <div v-if="errorMessage">
                            Ha succeit un error: {{ errorMessage }}
                        </div>
                        <v-list dense>
                            <v-list-tile v-for="tag in filteredTags" :key="tag.id">
                                <v-list-tile-content>
                                    <v-list-tile-title>
                                    <span :id="'tag' + tag.id">
                                    </span>
                                        <editable-text
                                                :text="tag.name"
                                                @edited="editName(tag, $event)"
                                        ></editable-text>
                                        <span :id="'delete_tag_id' + tag.id" @click="remove(tag)" class="cursor-pointer">&#215;</span>
                                    </v-list-tile-title>
                                </v-list-tile-content>&nbsp;
                            </v-list-tile>
                        </v-list>
                        <span id="filters" v-show="total > 0">
                <h3>Filtros:</h3>
                Active filter: {{ filter }}
                <div>
                    <br>
                    <button @click="setFilter('all')">Totes</button>
                    <button @click="setFilter('completed')">Completades</button>
                    <button @click="setFilter('active')">Pendents</button>
                </div>
            </span>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>
<script>
import EditableText from './EditableText'
import axios from 'axios'

var filters = {
  all: function (tags) {
    return tags
  }
  // completed: function (tags) {
  //   return tags.filter(function (tag) {
  //     // return tag.completed
  //     // NO CAL
  //     if (tag.completed === '1') return true
  //     else return false
  //   })
  // },
  // active: function (tags) {
  //   return tags.filter(function (tag) {
  //     if (tag.completed === '0') return true
  //     else return false
  //   })
  // }
}
export default {
  name: 'Tags',
  components: {
    'editable-text': EditableText
  },
  data () {
    return {
      filter: 'all', // All Completed Active
      newTag: '',
      dataTag: this.tags,
      errorMessage: null
    }
  },
  props: {
    'tags': {
      type: Array,
      default: function () {
        return []
      }
    }
  },
  computed: {
    total () {
      return this.dataTags.length
    },
    filteredTags () {
      // Segons el filtre actiu
      // Alternativa switch/case -> array associatiu
      return filters[this.filter](this.dataTags)
    }
  },
  watch: {
    tags (newTags) {
      this.dataTags = newTags
    }
  },
  methods: {
    editName (tag, text) {
      tag.name = text
    },
    setFilter (newFilter) {
      this.filter = newFilter
    },
    add () {
      if (this.newTag === '') return
      window.axios.post('/api/v1/tags', {
        name: this.newTag
      }).then((response) => {
        this.dataTags.splice(0, 0, { id: response.data.id, name: this.newTag })
        this.newTag = ''
      }).catch((error) => {
        console.log(error)
      })
    },
    remove (tag) {
      axios.delete('/api/v1/tags/' + tag.id).then((response) => {
        this.dataTags.splice(this.dataTags.indexOf(tag), 1)
      }).catch((error) => {
        console.log(error)
      })
      window.console.log(tag)
    }
  },
  created () {
    if (this.tags.length === 0) {
      window.axios.get('/api/v1/tags').then((response) => {
        console.log('prova******************')
        console.log(response.data)
        this.dataTags = response.data
      }).catch((error) => {
        this.errorMessage = error.response.data
      })
    }
  }
}
</script>

<style>
    .strike {
        text-decoration: line-through;
    }
</style>
