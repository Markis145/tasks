<template>
    <span>
        <v-dialog v-model="createDialog" :fullscreen="$vuetify.breakpoint.smAndDown" hide-overlay transition="dialog-bottom-transition"
                  @keydown.esc="createDialog=false">
            <v-toolbar color="primary" class="white--text">
                <v-btn icon flat class="white--text">
                    <v-icon class="mr-1" @click="createDialog=false">close</v-icon>
                </v-btn>
                <v-toolbar-title class="white--text">Crear Tag</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn flat class="white--text" @click="createDialog=false">
                    <v-icon class="mr-1" >exit_to_app</v-icon>
                    SORTIR
                </v-btn>
                <v-btn flat class="white--text" @click="add">
                   <v-icon class="mr-2">save</v-icon>
                   Guardar
                </v-btn>
            </v-toolbar>
            <v-card>
                <v-card-text>
                    <v-form>
                        <v-text-field v-model="newTag.name" label="Nom" hint="Nom del tag"
                                      placeholder="Nom del tag"></v-text-field>
                        <input type="color" v-model="newTag.color" style="width: 50px; height: 50px;">
                        <v-textarea v-model="newTag.description" label="Descripció" item-value="id"></v-textarea>
                        <div class="text-xs-center">
                            <v-btn @click="createDialog=false">
                                <v-icon class="mr-2">exit_to_app</v-icon>
                                Cancel·lar
                            </v-btn>
                            <v-btn color="success"
                                   @click="add()"
                                   :loading="creating"
                                   :disabled="creating">
                                <v-icon class="mr-2">save</v-icon>
                                Guardar
                            </v-btn>
                        </div>
                    </v-form>
                </v-card-text>
            </v-card>
        </v-dialog>
        <v-dialog v-model="editDialog" :fullscreen="$vuetify.breakpoint.smAndDown" hide-overlay transition="dialog-bottom-transition"
                  @keydown.esc="editDialog=false">
            <v-toolbar color="primary" class="white--text">
                <v-btn icon flat class="white--text">
                    <v-icon class="mr-1" @click="editDialog=false">close</v-icon>
                </v-btn>
                <v-toolbar-title class="white--text">Editar Tag</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn flat class="white--text" @click="editDialog=false">
                    <v-icon class="mr-1" >exit_to_app</v-icon>
                    SORTIR
                </v-btn>
                <v-btn flat class="white--text" @click="edit">
                    <v-icon class="mr-2">save</v-icon>
                    Guardar
                </v-btn>
            </v-toolbar>
            <v-card>
                <v-card-text>
                    <v-form>
                        <v-text-field v-model="tagBeingEdited.name" label="Nom" hint="Nom del tag" placeholder="Nom del tag"></v-text-field>
                        <v-text-field v-model="tagBeingEdited.color" label="Color" hint="Color" placeholder="Color"></v-text-field>
                        <v-textarea v-model="tagBeingEdited.description" label="Descripció"></v-textarea>
                        <div class="text-xs-center">
                            <v-btn @click="editDialog=false">
                                <v-icon class="mr-2">exit_to_app</v-icon>
                                Cancel·lar
                            </v-btn>
                            <v-btn color="success"
                                   @click="edit">
                                <v-icon class="mr-2">save</v-icon>
                                Guardar
                            </v-btn>
                        </div>
                    </v-form>
                </v-card-text>
            </v-card>
        </v-dialog>
        <v-dialog v-model="showDialog" :fullscreen="$vuetify.breakpoint.smAndDown" hide-overlay transition="dialog-bottom-transition"
                  @keydown.esc="showDialog=false">
            <v-toolbar color="primary" class="white--text">
                <v-btn icon flat class="white--text">
                    <v-icon class="mr-1" @click="showDialog=false">close</v-icon>
                </v-btn>
                <v-toolbar-title class="white--text">Mostrar tag</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn flat class="white--text" @click="showDialog=false">
                    <v-icon class="mr-1" >exit_to_app</v-icon>
                    SORTIR
                </v-btn>
            </v-toolbar>
            <v-card>
                <v-card-text>
                    <v-form>
                        <v-text-field disabled v-model="tagBeingShown.name" label="Nom" hint="Nom del tag" placeholder="Nom del tag"></v-text-field>
                        <v-text-field disabled v-model="tagBeingShown.color" label="Color" hint="Color" placeholder="Color"></v-text-field>
                        <v-textarea disabled v-model="tagBeingShown.description" label="Descripció"></v-textarea>
                    </v-form>
                </v-card-text>
            </v-card>
        </v-dialog>
        <v-toolbar color="primary">
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
            <v-toolbar-title class="white--text">Tags</v-toolbar-title>
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
                <v-layout wrap>
                    <v-flex lg6>
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
                    :items="dataTags"
                    :search="search"
                    no-results-text="No s'ha trobat cap registre coincident"
                    no-data-text="No hi ha dades disponibles"
                    rows-per-page-text="Tags per pàgina"
                    :rows-per-page-items="[5,10,25,50,100,200,{'text':'Tots','value':-1}]"
                    :loading="loading"
                    :pagination.sync="pagination"
                    class="hidden-md-and-down"
            >
                <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
                <template slot="items" slot-scope="{item: tag}">
                    <tr>
                        <td>{{ tag.id }}</td>
                        <td v-text="tag.name"></td>
                        <td v-text="tag.description"></td>
                        <td class="text-xs-left"><div class="elevation-2" :style="'background-color:' + tag.color+';border-radius: 4px;height: 15px;width: 15px;'"></div></td>
                        <td>
                            <span :title="tag.created_at_formatted">{{ tag.created_at_human }}</span>
                        </td>
                        <td>
                            <span :title="tag.updated_at_formatted">{{ tag.updated_at_human }}</span>
                        </td>
                        <td>
                            <v-btn v-if="$can('tags.show', tags)" icon color="primary" flat title="Mostrar tag"
                                   @click="showShow(tag)">
                                <v-icon>visibility</v-icon>
                            </v-btn>
                            <v-btn v-if="$can('tags.update', tags)" icon color="success" flat title="Editar tag"
                                   @click="showUpdate(tag)">
                                <v-icon>edit</v-icon>
                            </v-btn>
                            <v-btn v-if="$can('tags.destroy', tags)" icon color="accent" flat title="Eliminar tag"
                                   :loading="removing === tag.id" :disabled="removing === tag.id" @click="destroy(tag)">
                                <v-icon>delete</v-icon>
                            </v-btn>
                        </td>
                    </tr>
                </template>
            </v-data-table>
            <v-data-iterator class="hidden-lg-and-up"
                             :items="dataTags"
                             :search="search"
                             no-results-text="No s'ha trobat cap registre coincident"
                             no-data-text="No hi ha dades disponibles"
                             rows-per-page-text="Tags per pàgina"
                             :rows-per-page-items="[5,10,25,50,100,200,{'text':'Tots','value':-1}]"
                             :loading="loading"
                             :pagination.sync="pagination"
            >
                <v-flex
                        slot="item"
                        slot-scope="{item:tag}"
                        xs12
                        sm6
                        md4
                >
                    <v-card class="mb-1">
                        <v-list>
                            <v-card-title><h3 class="font-weight-bold">{{ tag.name }}</h3></v-card-title>
                            <v-list-tile>
                              <v-list-tile-content class="font-italic">{{ tag.description }}</v-list-tile-content>
                                <v-list-tile-content class="align-end"><div class="elevation-2" :style="'background-color:' + tag.color+';border-radius: 4px;height: 15px;width: 15px;'"></div></v-list-tile-content>
                            </v-list-tile>
                            <v-list-tile>
                                <v-list-tile-content class="align-center">
                                    <v-btn v-if="$can('tags.show', tags)" icon color="primary" flat title="Mostrar tag"
                                         @click="showShow(tag)">
                                        <v-icon>visibility</v-icon>
                                    </v-btn>
                                </v-list-tile-content>
                                <v-list-tile-content class="align-center">
                                    <v-btn v-if="$can('tags.update', tags)" icon color="success" flat title="Editar tag"
                                           @click="showUpdate(tag)">
                                        <v-icon>edit</v-icon>
                                    </v-btn>
                                </v-list-tile-content>
                                <v-list-tile-content class="align-center">
                                    <v-btn v-if="$can('tags.destroy', tags)" icon color="error" flat title="Eliminar tag"
                                           :loading="removing === tag.id" :disabled="removing === tag.id" @click="destroy(tag)">
                                        <v-icon>delete</v-icon>
                                    </v-btn>
                                </v-list-tile-content>
                            </v-list-tile>
                        </v-list>
                    </v-card>
                </v-flex>
            </v-data-iterator>
        </v-card>
        <v-btn
                v-if="$can('tags.store', tags)"
                @click="showCreate"
                fab
                bottom
                right
                fixed
                color="accent"
                class="white--text"
        >
            <v-icon>add</v-icon>
        </v-btn>
    </span>
</template>

<script>
export default {
  name: 'Tags',
  data () {
    return {
      tagBeingEdited: '',
      tagBeingShown: '',
      newTag: {
        name: '',
        color: '',
        description: ''
      },
      name: '',
      color: '',
      description: '',
      createDialog: false,
      editDialog: false,
      showDialog: false,
      tagBeingRemoved: null,
      search: '',
      pagination: {
        rowsPerPage: 25
      },
      loading: false,
      creating: false,
      editing: false,
      removing: null,
      dataTags: this.tags,
      headers: [
        { text: 'Id', value: 'id' },
        { text: 'Name', value: 'name' },
        { text: 'Descripció', value: 'description' },
        { text: 'Color', value: 'color' },
        { text: 'Creat', value: 'created_at_timestamp' },
        { text: 'Modificat', value: 'updated_at_timestamp' },
        { text: 'Accions', sortable: false, value: 'full_search' }
      ]
    }
  },
  props: {
    tags: {
      type: Array,
      required: true
    },
    uri: {
      type: String,
      required: true
    }
  },
  methods: {
    showUpdate (tag) {
      this.editDialog = true
      this.tagBeingEdited = tag
    },
    showShow (tag) {
      this.showDialog = true
      this.tagBeingShown = tag
    },
    opcio1 () {
      console.log('Todo Opcio')
    },
    showCreate () {
      this.createDialog = true
    },
    removeTag (tag) {
      this.dataTags.splice(this.dataTags.indexOf(tag), 1)
    },
    createTag (tag) {
      this.dataTags.splice(0, 0, tag)
    },
    editTag (editedTag) {
      this.dataTags.splice(this.dataTags.indexOf(editedTag), 1, editedTag)
    },
    add () {
      console.log(this.newTask)
      window.axios.post(this.uri, this.newTag).then((response) => {
        this.createTag(response.data)
        this.$snackbar.showMessage("S'ha creat correctament el tag")
        this.createDialog = false
        this.newTag.name = ''
        this.newTag.description = ''
        this.newTag.color = ''
        this.refresh()
      }).catch(error => {

      })
    },
    async destroy (tag) {
      let result = await this.$confirm('Els tags esborrats no es poden recuperar',
        {
          title: 'Esteu segurs?',
          buttonTrueText: 'Eliminar',
          buttonFalseText: 'Cancel·lar',
          color: 'red'
        })
      if (result) {
        this.removing = tag.id
        window.axios.delete(this.uri + '/' + tag.id).then(() => {
          this.removeTag(tag)
          this.deleteDialog = false
          tag = null
          this.$snackbar.showMessage("S'ha esborrat correctament el tag")
          this.removing = null
          this.refresh()
        }).catch(error => {
          this.removing = null
        })
      }
    },
    edit () {
      console.log(this.tagBeingEdited)
      window.axios.put(this.uri + '/' + this.tagBeingEdited.id, this.tagBeingEdited).then((response) => {
        this.editTag(response.data)
        console.log(response.data)
        this.$snackbar.showMessage("El tag s'ha editat correctament")
        this.editDialog = false
        this.refresh()
      }).catch(error => {
      })
    },
    refresh () {
      this.loading = true
      window.axios.get(this.uri).then(response => {
        this.dataTags = response.data
        this.loading = false
        this.$snackbar.showMessage('Tags actualitzats correctament')
      }).catch(error => {
        this.loading = false
      })
    },
    created () {
      console.log('Usuari logat')
      console.log(window.laravel_user)
    }
  }
}
</script>
