<!--<template>-->
        <!--<div class="container flex justify-center flex-row" >-->
            <!--<div class="flex flex-col">-->
                <!--<h1 class="text-center text-red-light">Tasques</h1>-->
                <!--<input type="text" placeholder="Nova Tasca"-->
                       <!--v-model="newTask" @keyup.enter="add"-->
                       <!--class="m-3 mt-5 p-2 pl-5 shadow border rounded focus:outline-none focus:shadow-outline text-grey-darker">-->
                <!--<button @click="add">Afegir</button>-->
                <!--<ul>-->
                    <!--<li v-for="task in filteredTasks" :key="task.id" >-->
                        <!--<span :class="{ strike: task.completed }">{{task.name}}</span>-->
                        <!--&nbsp;-->
                        <!--<span @click="remove(task)">&#215;</span>-->
                    <!--</li>-->
                <!--</ul>-->

                <!--<h3>Filtros</h3>-->
                <!--Activa filter: {{ filter }}-->
                <!--<ul>-->
                    <!--<li><button @click="setFilter('All')">Totes</button></li>-->
                    <!--<li><button @click="setFilter('Completed')">Completades</button></li>-->
                    <!--<li><button @click="setFilter('Active')">Pendents</button></li>-->
                <!--</ul>-->
            <!--</div>-->
        <!--</div>-->
<!--</template>-->

<!--<script>-->

    <!--var filters = {-->
        <!--all: function(tasks){-->
            <!--return tasks-->
        <!--} ,-->
        <!--completed: function(tasks){-->
            <!--return tasks.filter(function (task) {-->
                <!--return task.completed-->
                <!--// if (task.completed) return true-->
                <!--// return false-->
            <!--})-->
        <!--},-->
        <!--active: function(tasks){-->
            <!--return tasks.filter(function (task) {-->
                <!--return !task.completed-->
                <!--// if (!task.completed) return true-->
                <!--// return false-->
            <!--})-->
        <!--},-->
    <!--}-->
    <!--//document.getEkebementById-->
    <!--export default {-->
        <!--data(){-->
            <!--return {-->
                <!--filter: 'All', //all completed actual-->
                <!--newTask:'',-->
                <!--tasks: [-->
                    <!--{-->
                        <!--id: 1,-->
                        <!--name:'Comprar pa ',-->
                        <!--completed:false-->
                    <!--},-->
                    <!--{-->
                        <!--id: 2,-->
                        <!--name:'Comprar llet ',-->
                        <!--completed:true-->
                    <!--},-->
                    <!--{-->
                        <!--id: 3,-->
                        <!--name:'Estudiar php ',-->
                        <!--completed:false-->
                    <!--},-->
                <!--]-->
            <!--}-->
        <!--},-->

        <!--computed: {-->
            <!--total(){-->
              <!--return this.tasks.length-->
            <!--},-->
          <!--filteredTasks(){-->
              <!--//segons el filtre actiu-->
              <!--//alternativa switch/case -> array asociatiu-->
              <!--return filters[this.filter](this.tasks)-->
          <!--}-->
        <!--},-->
        <!--methods:{-->
            <!--setFilter(newFilter){-->
              <!--console.log(xivato);-->
              <!--console.log(newFilter);-->
              <!--this.filter = newFilter-->
            <!--},-->
            <!--add(){-->
                <!--// console.log('TODO ADD')-->
                <!--this.tasks.splice(0,0,{name:this.newTask,completed:false})-->
                <!--this.newTask=''-->
            <!--},-->
            <!--remove(task) {-->
                <!--window.console.log(task);-->
                <!--this.tasks.splice(this.tasks.indexOf(task),1)-->
            <!--}-->
        <!--}-->
    <!--}-->
    <!--// {-->
    <!--//     marca:'Renault',-->
    <!--//     consum:'5l/100',-->
    <!--//     start: function (){-->
    <!--//         console.log('arraca');-->
    <!--// }-->
    <!--//-->
    <!--// }-->
<!--</script>-->

<!--<style>-->
    <!--.strike{-->
        <!--text-decoration: line-through;-->
    <!--}-->

<!--</style>-->

<!--<template>-->
    <!--<div class="flex justify-center">-->
        <!--<div class="flex flex-col">-->
            <!--<h1 class="text-center text-red-light">Tasques ({{total}})</h1>-->
            <!--<div>-->
                <!--<input type="text"-->
                       <!--v-model="newTask" @keyup.enter="add"  placeholder="Nova Tasca" class="m-3 p-2 shadow border rounded focus:outline-none focus:shadow-outline text-grey-dark">-->
                <!--<svg @click="add" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M11 9h4v2h-4v4H9v-4H5V9h4V5h2v4zm-1 11a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"/></svg>-->

            <!--</div>-->
            <!--<div v-for="task in filteredTasks" :key="task.id">-->
            <!--<span :class="{ strike:task.completed }">-->
                <!--<editable-text-->
                        <!--:text="task.name"-->
                        <!--@edited="editName(task, $event)"-->
                <!--&gt;</editable-text>-->
            <!--</span>-->
                <!--&nbsp;-->
                <!--<span @click="remove(task)" class="cursor-pointer">&#215;</span>-->
            <!--</div>-->
            <!--<h3>Filtros</h3>-->
            <!--Activa filter: {{filter}}-->

            <!--<div class="h-4">-->
                <!--<button @click="setFilter=('all')">Totes</button>-->
                <!--&nbsp;-->
                <!--<button @click="setFilter('completed')">Completades</button>-->
                <!--&nbsp;-->
                <!--<button @click="setFilter=('active')">Pendents</button>-->
            <!--</div>-->

        <!--</div>-->

    <!--</div>-->
<!--</template>-->



<!--<script>-->
    <!--import EditableText from './EditableText.vue'-->
    <!--var filters = {-->
        <!--all: function(tasks){-->
            <!--return tasks-->
        <!--},-->
        <!--completed: function(tasks){-->
            <!--return tasks.filter(function(task) {-->
                <!--return task.completed-->
            <!--})-->
        <!--},-->
        <!--active: function(tasks){-->
            <!--return tasks.filter(function(task) {-->
                <!--return !task.completed-->
            <!--})-->
        <!--},-->
    <!--}-->
    <!--export default {-->
        <!--components: {-->
            <!--'editable-text': EditableText-->
        <!--},-->
        <!--data(){-->
            <!--return {-->
                <!--filter: 'all',-->
                <!--newTask: '',-->
                <!--tasks: [-->
                    <!--{-->
                        <!--id: '1',-->
                        <!--name:   'comprar pa',-->
                        <!--completed: false-->
                    <!--},-->
                    <!--{-->
                        <!--id: '2',-->
                        <!--name:   'comprar llet',-->
                        <!--completed: false-->
                    <!--},-->
                    <!--{-->
                        <!--id: '3',-->
                        <!--name:   'Estudiar PHP',-->
                        <!--completed: true-->
                    <!--},-->
                <!--]-->
            <!--}-->
        <!--},-->
        <!--computed: {-->
            <!--total(){-->
                <!--return this.tasks.length-->
            <!--},-->
            <!--filteredTasks(){-->
                <!--return filters[this.filter](this.tasks)-->
            <!--}-->
        <!--},-->
        <!--methods: {-->
            <!--editName(task,text){-->
                <!--task.name = text-->
            <!--},-->
            <!--setFilter(newFilter){-->
                <!--this.filter= newFilter-->
            <!--},-->
            <!--add() {-->
                <!--this.tasks.splice(0,0,{name: this.newTask, completed: false})-->
                <!--this.newTask=''-->
            <!--},-->
            <!--remove(task) {-->
                <!--this.tasks.splice(this.tasks.indexOf(task),1)-->
            <!--}-->
        <!--}-->
    <!--}-->
<!--</script>-->

<!--<style>-->
    <!--.strike {-->
        <!--text-decoration: line-through;-->
    <!--}-->
    <!--.cursor-pointer:hover {-->
        <!--cursor: pointer;-->
    <!--}-->
<!--</style>-->

<template>
    <div class="flex justify-center">
        <div class="flex flex-col">
            <h1 class="text-center text-red-light">Tasques({{total}}) </h1>
            <div class="flex-row"  >

                <input type="text" placeholder="Nova Tasca"
                       v-model="newTask" @keyup.enter="add"
                       class="m-3 mt-5 p-2 pl-5 shadow border rounded focus:outline-none focus:shadow-outline text-grey-darker">
                <button @click="add" class="text-center text-red"  >Afegir</button>
            </div>
            <!-- -->
            <ul>
                <li v-for="task in filteredTasks" :key="task.id">
                <span :class="{ strike: task.completed == '1'}">
                    <editable-text
                            :text="task.name"
                            @edited="editName(task, $event)"
                    ></editable-text>
                </span>
                    <span @click="remove(task)">&#215;</span>
                </li>
            </ul>
            <!-- -->
            <br>
            <h3>Filtros:</h3>
            <br>
            Filtre emprat -> {{ filter }}

            <ul>
                <br>
                <li><button @click="setFilter('all')">Totes</button></li>
                <li><button @click="setFilter('completed')">Completades</button></li>
                <li><button @click="setFilter('active')">Pendents</button></li>
            </ul>
        </div>
    </div>
</template>
<script>
    import EditableText from './EditableText'
    var filters = {
        all: function(tasks) {
            return tasks
        },
        completed: function(tasks) {
            return tasks.filter(function (task) {
                return task.completed
                // NO CAL
                // if (task.completed) return true
                // else return false
            })
        },
        active: function(tasks) {
            return tasks.filter(function (task) {
                return !task.completed
            })
        },
    }
    export default {
        name: 'Tasks',
        components: {
            'editable-text': EditableText
        },
        data() {
            return {
                filter: 'all', // All Completed Active
                newTask: '',
                dataTasks: this.tasks
            }
        },
        props: {
          'tasks': {
              type: Array,
              default: function(){
                  return []
              }
          }
        },
        computed: {
            total() {
                return this.dataTasks.length
            },
            filteredTasks() {
                // Segons el filtre actiu
                // Alternativa switch/case -> array associatiu
                return filters[this.filter](this.dataTasks)
            }
        },
        watch: {
            tasks(newTasks){
                this.dataTasks = newTasks
            }
        },
        methods: {
            editName(task,text){
                task.name=text
            },
            setFilter(newFilter) {
                this.filter = newFilter
            },
            add() {
                this.dataTasks.splice(0,0,{ name: this.newTask, completed: false } )
                this.newTask=''
            },
            remove(task) {
                window.console.log(task)
                this.dataTasks.splice(this.dataTasks.indexOf(task),1)
            }
        },
        created() {
            console.log('Component Tasks ha estat creat');
        }
    }
</script>

<style>
    .strike {
        text-decoration: line-through;
    }
</style>
